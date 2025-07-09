<?php

namespace App\Mainframe\Jobs;

use App\SystemEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobAsyncSave implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const FAIL = 'Fail';
    private const SUCCESS = 'Success';

    /** @var \App\Mainframe\Features\Modular\Validator\ModelProcessor|mixed|\App\Mainframe\Features\Modular\BaseModule\BaseModule */
    public $class;

    /** @var string */
    public $function;
    public $element;

    /**
     * Create a new job instance.
     *
     * @param  \App\Mainframe\Features\Modular\Validator\ModelProcessor  $class
     */
    public function __construct($class, $function = null)
    {
        $this->class = $class;
        $this->function = $function ?: 'save';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $validable = $this->class->{$this->function}();

        if (isset($validable->element)) {
            $this->element = $validable->element;
        }

        # Log failure
        if ($validable->isInvalid()) {
            $this->log(self::FAIL.' '.$this->msg(), [
                'type' => 'Error',
                'details' => $this->class->getErrorsAsSting(),
            ], $this->element);

            return;
        }

        # Log Success
        $this->log(self::SUCCESS.' '.$this->msg(), [
            'type' => 'Success',
            'details' => [],
        ], $this->element);
    }

    /**
     * Return error msg
     *
     * @return string
     */
    public function msg()
    {
        $str = class_basename($this)." | ";
        $str .= get_class($this->class).'::'.$this->function.'(). ';
        if ($this->element) {
            $str .= ' Element '.$this->element->moduleName()."({$this->element->id})";
        }

        return $str;
    }

    /**
     * Store a system event
     *
     * @param  string  $name
     * @param  array  $params
     * @param $model
     * @return void
     */
    public function log(string $name, array $params = [], $model = null)
    {
        $systemEvent = new SystemEvent();

        $systemEvent->name = $name;
        $systemEvent->fill($params);
        $systemEvent->occurred_at = now();

        if ($model) {
            $systemEvent->module_id = $model->module()->id;
            $systemEvent->element_id = $model->id;
            $systemEvent->element_uuid = $model->uuid;
        }

        $systemEvent->processor()->save();
    }
}

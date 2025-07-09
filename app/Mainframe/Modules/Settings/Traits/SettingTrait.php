<?php

namespace App\Mainframe\Modules\Settings\Traits;

use App\Module;
use App\Setting;
use App\Project\Modules\Emails\Email;

trait SettingTrait
{
    /**
     * A shorthand function to get setting by name
     *
     * @param $name
     * @param  bool  $cache
     * @return array|bool|mixed|null|string
     */
    public static function read($name, bool $cache = true)
    {
        /** @var Setting $setting */

        # Get the current version
        if (!$cache) {
            $setting = Setting::where('name', $name)->first();
            if ($setting) {
                return $setting->getValue();
            }
        }

        # Get the cached version
        if ($setting = Setting::where('name', $name)->remember(timer('long'))->first()) {
            return $setting->getValue();
        }

        return null;
    }

    /**
     * Function to get the setting value. The value can be boolean, string, array(json) or files
     */
    public function getValue()
    {

        $val = $this->value;

        switch ($this->type) {
            case 'boolean':
                $val = $this->value == 'true';
                break;
            case 'string':
                $val = $this->value;
                break;
            case 'array':
                $val = json_decode($this->value, true);
                break;
            case 'csv':
                $val = csvToArray($this->value);
                break;
            case 'file':
                $files = [];
                if ($this->uploads()->exists()) {
                    foreach ($this->uploads as $upload) {
                        $files[] = $upload->url;
                    }
                }

                $val = $files;
                break;
        }

        return $val;
    }

    /**
     * Send email notification
     *
     * @return void
     */
    public function sendEmail()
    {
        /*
        |--------------------------------------------------------------------------
        | Step 1. Save the \App\Email entry
        |--------------------------------------------------------------------------
        */
        $email = new Email();
        $email->subject = 'Test Setting Save | '.now();
        $email->to = ['test@gmail.com'];
        // $email->cc = [];
        // $email->bcc = [];
        $email->html = view('project.emails.test-mail', ['setting' => $this]);
        $email->name = $email->subject;
        $email->module_id = Module::byName($this->moduleName)->id;
        $email->element_id = $this->id;
        $processor = $email->processor()->save();

        /*
        |--------------------------------------------------------------------------
        | Step 2. Send the email
        |--------------------------------------------------------------------------
        */
        if ($processor->isValid()) {
            // $email->send();
            $email->queue();
        }

    }

}

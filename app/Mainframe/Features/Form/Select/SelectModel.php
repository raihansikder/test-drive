<?php

namespace App\Mainframe\Features\Form\Select;

use Cache;
use App\Module;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;
use App\Mainframe\Features\Modular\BaseModule\BaseModule;

class SelectModel extends SelectArray
{
    public $nameField;
    public $valueField;
    public $orderBy;
    public $table;

    /** @var BaseModule|null */
    public $model;
    public $query;
    public $result;
    public $showInactive;
    public $cache = 5;
    public $dataAttributes;
    public $link = false;
    public $dry = false; // if true, no DB query will run to fetch results. Useful when you want to show an empty choice at some stage

    /**
     * SelectModel constructor.
     *
     * @param  array  $var
     * @param  null  $element
     */
    public function __construct($var = [], $element = null)
    {
        parent::__construct($var, $element);

        $this->nameField = $this->var['name_field'] ?? 'name';
        $this->valueField = $this->var['value_field'] ?? 'id';
        $this->orderBy = $this->var['order_by'] ?? $this->nameField;

        $this->table = $this->var['table'] ?? null; // Must have table
        $this->model = $this->var['model'] ?? null; // Must have table
        $this->setModel();

        $this->query = $this->getQuery(); // DB::table($this->table);
        $this->showInactive = $this->var['show_inactive'] ?? false;
        $this->cache = $this->var['cache'] ?? $this->cache;
        $this->dataAttributes = $this->var['data_attributes'] ?? [];
        $this->link = $this->var['link'] ?? $this->link;
        $this->dry = $this->var['dry'] ?? $this->dry;

        $this->options = $this->options();
    }

    public function setModel()
    {
        if (isset($this->var['model'])) {
            $model = $this->var['model'];
            if (is_string($model)) {
                $model = new $model;
            }
            $this->model = $model;
        }

        if (isset($this->var['table'])) {
            $table = $this->var['table'];
            if ($module = Module::fromTable($table)) {
                $this->model = $module->modelInstance();
            }
        }

        return $this;
    }

    /**
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function getQuery()
    {
        return $this->var['query'] ?? $this->model;
    }

    /**
     * Select options
     *
     * @return array
     */
    public function options()
    {
        if ($this->dry) {
            return [];
        }
        $options = $this->result()
            ->pluck($this->nameField, $this->valueField)
            ->toArray();

        // $options[0] = null; // Zero fill empty selection
        if (!$this->isMultiple()) {
            $options[null] = $this->nullOptionText;  // Null fill empty selection
        }

        return Arr::sort($options);
    }

    /**
     * Get a query result with all necessary fields
     *
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function result()
    {
        if ($this->dry) {
            return [];
        }

        if ($this->result) {
            return $this->result;
        }

        $q = $this->query
            ->select($this->columns())
            ->whereNull('deleted_at');

        if (!$this->showInactive) {
            $q->where('is_active', 1);
        }

        // Inject tenant context.
        if ($this->inTenantContext()) {
            $q->where(function ($q) {
                /** @var Builder $q */
                $q->where('tenant_id', user()->tenant_id)->orWhereNull('tenant_id');
            });
        }

        $q->orderBy($this->orderBy);

        $this->result = Cache::remember($this->cacheKey(), $this->cache, function () use ($q) {
            return $q->get();
        });

        return $this->result;
    }

    /**
     * Query on columns
     *
     * @return array
     */
    public function columns()
    {

        $columns = [$this->nameField, $this->valueField];

        foreach ($this->dataAttributes as $attribute) {

            // Include in columns if the attribute exists
            if ($this->model->hasColumn($attribute)) {
                $columns[] = $attribute;
            }
        }

        return $columns;
    }

    /**
     * Check if currently in tenant context.
     *
     * @return bool
     */
    public function inTenantContext()
    {
        return user()->ofTenant() && isset($this->model) && $this->model->hasTenantContext();
    }

    public function cacheKey()
    {
        return 'select-'.$this->name.'-'.user()->id;
    }

    /**
     * Print value
     *
     * @return null|array|\Illuminate\Http\Request|string
     */
    public function print()
    {
        return $this->options()[$this->value()] ?? '';
    }

    public function label()
    {

        if ($this->value()) {
            if (is_array($this->value())) {
                return parent::label();

            } elseif (isset($this->model) && $this->link) {
                $target = $this->model->query()->remember(timer('long'))->find($this->value());

                if ($target && !is_array($target)) {
                    $link = " <a href='".$target->editUrl()."' target='_blank' class='label-open-link'><ion-icon name='open-outline'></ion-icon></a>";
                    return $this->label.$link;
                }
            }
        }

        return parent::label();
    }

}

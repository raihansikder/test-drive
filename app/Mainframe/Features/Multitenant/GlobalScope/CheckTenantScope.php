<?php

namespace App\Mainframe\Features\Multitenant\GlobalScope;

use App\Mainframe\Features\Modular\BaseModule\BaseModule;
use App\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CheckTenantScope implements Scope
{
    /**
     * @var int|null
     */
    public $tenantId;

    public function __construct($tenantId = null)
    {
        $this->tenantId = $tenantId;
    }

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @return void
     *
     * @noinspection UnknownColumnInspection
     */
    public function apply(Builder $builder, Model $model)
    {
        /** @var BaseModule $model */
        if ($model->hasTenantContext()) {
            $builder->where(function (Builder $q) use ($model) {

                $column = $model->getTable().'.tenant_id';

                if ($this->tenantId) {
                    $q->where($column, $this->tenantId);
                }

                // Include global tenant elements
                if ($model->showGlobalTenantElements()) {
                    $q->orWhere($column, Tenant::globalTenantId());
                }

                // Include null tenant elements
                if ($model->showNonTenantElements()) {
                    $q->orWhereNull($column);
                }
            });

        }
    }
}

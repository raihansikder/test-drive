<?php

namespace App\Mainframe\Modules\Assignments;

use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Modules\Assignments\Traits\AssignmentTrait;

class Assignment extends BaseModule
{
    use AssignmentTrait;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'project_id',
        'tenant_id',
        'uuid',
        'name',
        'type',
        'module_id',
        'element_id',
        'element_uuid',
        'assignable_type',
        'assignable_id',
        'assignee_user_id',
        'status',
        'note',
        'name_ext',
        'slug',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */

    public $emailTemplate = 'project.emails.assignment-created';

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    // Note: Place boot() method in project class
}

<?php

namespace App\Mainframe\Modules\SupportTicketCategories;

use App\Project\Features\Modular\BaseModule\BaseModule;
use App\Mainframe\Features\Plugins\MultiLevelModel\MultiLevelModelTrait;
use App\Mainframe\Modules\SupportTicketCategories\Traits\SupportTicketCategoryTrait;

class SupportTicketCategory extends BaseModule
{
    use SupportTicketCategoryTrait, MultiLevelModelTrait;

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
        'name_ext',
        'email_recipients',
        'parent_id',
        'parent_name',
        'upper_level_ids',
        'lower_level_ids',
        'parallel_level_ids',
        'order',
        'slug',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'lower_level_ids' => 'array',
        'upper_level_ids' => 'array',
        'parallel_level_ids' => 'array',
        'email_recipients' => 'array',
    ];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];

}

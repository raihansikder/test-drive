<?php

namespace App\Mainframe\Modules\SupportTicketCategories;

use App\Mainframe\Modules\SupportTicketCategories\Traits\SupportTicketCategoryDatatableTrait;
use App\Project\Features\Datatable\ModuleDatatable;

class SupportTicketCategoryDatatable extends ModuleDatatable
{
    use SupportTicketCategoryDatatableTrait;
}

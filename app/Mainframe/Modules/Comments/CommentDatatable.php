<?php

namespace App\Mainframe\Modules\Comments;

use App\Mainframe\Modules\Comments\Traits\CommentDatatableTrait;
use App\Project\Features\Datatable\ModuleDatatable;

class CommentDatatable extends ModuleDatatable
{
    use CommentDatatableTrait;
}

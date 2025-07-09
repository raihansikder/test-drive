<?php

namespace App\Mainframe\Modules\Comments;

use App\Project\Features\Datatable\ModuleDatatable;
use App\Mainframe\Modules\Comments\Traits\CommentDatatableTrait;

class CommentDatatable extends ModuleDatatable
{
    use CommentDatatableTrait;
}

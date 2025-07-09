<?php

namespace App\Project\Datatables;

use App\Project\Modules\Assignments\AssignmentDatatable;
use App\Mainframe\Features\Datatable\Traits\CustomDatatableTrait;

class AssignmentWidgetDatatable extends AssignmentDatatable
{

    use CustomDatatableTrait;

    /*---------------------------------
    | Section : Define columns
    |---------------------------------*/
    /**
     * @return array
     */
    public function columns()
    {
        return [
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.created_at', 'created_at', "<span style='width:80px; float:left'>Assignee</span>"],
            [$this->table.'.name', 'name', 'Name'],
            [$this->table.'.note', 'note', "<span style='width:280px; float:left'>Message</span>"],
            [$this->table.'.created_by', 'created_by', 'Created By'],
            // [$this->table.'.is_active', 'is_active', 'Active'],
        ];
    }
    /*---------------------------------
    | Section: SQL Select query
    |---------------------------------*/
    // /**
    //  * Construct SELECT statement (field1 AS f1, field2 as f2...)
    //  *
    //  * @return array
    //  */
    public function selects()
    {
        $columns = array_merge($this->columns(), [
            [$this->table.'.assignee_user_id', 'assignee_user_id', 'Assignee User'],
        ]);

        return $this->selectQueryString($columns);
    }
    /*---------------------------------
   | Section : Modify row-columns
   |---------------------------------*/
    /**
     * @param  \Yajra\DataTables\DataTableAbstract  $dt
     * @return mixed|\Yajra\DataTables\DataTableAbstract
     */
    public function modify($dt)
    {
        $dt = parent::modify($dt);

        if ($this->hasColumn('created_at')) {
            $dt->editColumn('created_at', function ($row) {
                return "<span class='text-bold'>".optional($row->assignee)->name."</span><br/> "
                    ."<span class=''>".formatDateTime($row->created_at)."</span>"
                    // ."<br/> ".optional($row->creator)->name
                    // ." ".optional($row->creator)->email
                    ;
            }
            );
        }

        return $dt;
    }
}

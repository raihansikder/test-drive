<?php

namespace App\Project\Datatables;

use App\Project\Modules\Districts\DistrictDatatable;
use App\Mainframe\Features\Datatable\Traits\CustomDatatableTrait;

class DistrictWidgetDatatable extends DistrictDatatable
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
            [$this->table.'.name', 'name', 'Name'],
            [$this->table.'.code', 'code', 'Code'],
            [$this->table.'.combined_code', 'combined_code', 'Combined Code'],
            [$this->table.'.is_active', 'action', '-'],
        ];
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

        if ($this->hasColumn('action')) {
            $dt->editColumn('action', function ($row) {
                /** @var \App\District $row */
                $var = [
                    'route' => route('districts.destroy', $row->id),
                    'redirect_success' => $row->division_id ? route('divisions.edit', $row->division_id) : '#',
                    'name' => 'listItemDeleteBtn',
                    'class' => 'btn btn-xs btn-transparent-red pull-right',
                    'value' => '<i class="fa fa-trash"></i>',
                    'params' => [
                        'title' => 'Delete',
                        'onclick' => 'showDeleteModalForBtn($(this))',
                    ],
                ];

                return view('form.delete-button', ['var' => $var]);
            });
        }

        return $dt;
    }

}

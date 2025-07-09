<?php

namespace App\Project\Datatables;

use App\Project\Modules\Upazilas\UpazilaDatatable;
use App\Mainframe\Features\Datatable\Traits\CustomDatatableTrait;

class UpazilaWidgetDatatable extends UpazilaDatatable
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

    public function modify($dt)
    {
        $dt = parent::modify($dt);

        if ($this->hasColumn('action')) {
            $dt->editColumn('action', function ($row) {
                /** @var \App\Upazila $row */
                $var = [
                    'route' => route('upazilas.destroy', $row->id),
                    'redirect_success' => $row->district_id ? route('districts.edit', $row->district_id) : '#',
                    'name' => 'listItemDeleteBtn',
                    'class' => 'btn btn-xs btn-transparent-red pull-right',
                    'value' => '<i class="fa fa-trash"></i>',
                    'params' => [
                        'title' => 'Delete',
                        'onclick' => 'showDeleteModalForBtn($(this))', // JS function to call on click
                        'data-refresh_datatable_id' => $this->id(),
                        // 'data-hide_class' => 'label_longitude',
                    ],
                ];

                return view('form.delete-button', ['var' => $var]);
            });
        }

        return $dt;
    }

}

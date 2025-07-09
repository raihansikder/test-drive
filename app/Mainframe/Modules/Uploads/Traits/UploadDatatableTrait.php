<?php

namespace App\Mainframe\Modules\Uploads\Traits;

use App\Upload;

trait UploadDatatableTrait
{
    /*---------------------------------
    | Section : Define query tables/model
    |---------------------------------*/
    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function source()
    {
        // return \DB::table($this->table)->leftJoin('users as updater', 'updater.id', $this->table.'.updated_by'); // Old table based implementation
        return Upload::with(['updater:id,name', 'uploadable:id']); // Model based query.
    }

    /**
     * @return array
     */
    public function columns()
    {
        return [
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.name', 'name', 'Name'],
            [$this->table.'.uploadable_type', 'uploadable_type', 'Module'],
            [$this->table.'.uploadable_id', 'uploadable_id', 'Element'],
            [$this->table.'.updated_by', 'updated_by', 'Updated By'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
            [$this->table.'.is_active', 'is_active', 'Active'],
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

        if ($this->hasColumn('uploadable_id')) {
            $dt->editColumn('uploadable_id', function ($row) {
                /** @var Upload $row */
                if ($row->uploadable) {
                    return $row->uploadable->editLink();
                }

                return $row->uploadable_id;
            });
        }

        return $dt;
    }
}

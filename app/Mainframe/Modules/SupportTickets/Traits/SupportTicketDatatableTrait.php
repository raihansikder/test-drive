<?php

namespace App\Mainframe\Modules\SupportTickets\Traits;

use Str;
use Arr;
use App\SupportTicket;
use App\Project\Modules\SupportTickets\SupportTicketDatatable;

/** @mixin SupportTicketDatatable */
trait SupportTicketDatatableTrait
{

    public $moduleName = 'support-tickets';

    /*---------------------------------
    | Section : Define query tables/model
    |---------------------------------*/
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function source()
    {
        // return \DB::table($this->table)->leftJoin('users as updater', 'updater.id', $this->table.'.updated_by'); // Old table based implementation
        return SupportTicket::with(['updater:id,name', 'supportTicketTagIds',]);
    }

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
            [$this->table.'.name', 'name', 'Subject'],
            [$this->table.'.primary_category_name', 'primary_category_name', 'Primary Category'],
            [$this->table.'.secondary_category_name', 'secondary_category_name', 'Category'],
            // [$this->table.'.division_name', 'division_name', 'Division'],
            // [$this->table.'.district_name', 'district_name', 'District'],
            // [$this->table.'.upazila_name', 'upazila_name', 'Upazila'],
            [$this->table.'.status_name', 'status_name', 'Status'],
            [$this->table.'.support_ticket_tag_names', 'support_ticket_tag_names', 'Tags'],
            [$this->table.'.updated_by', 'updated_by', 'Updater'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
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
            [$this->table.'.primary_category_id', 'primary_category_id'],
            [$this->table.'.secondary_category_id', 'secondary_category_id'],
        ]);

        return $this->selectQueryString($columns);
    }

    /*---------------------------------
    | Section: Filters
    |---------------------------------*/
    // /**
    //  * @param  \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed  $query
    //  * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed
    //  */
    public function filter($query)
    {
        $query = parent::filter($query);
        if ($val = request('status_name')) { // Example code
            $query->whereIn('status_name', Arr::wrap($val));
        }
        if (request('primary_category_id')) { // Example code
            $query->whereIn('primary_category_id', Arr::wrap(request('primary_category_id')));
        }
        if (request('secondary_category_id')) { // Example code
            $query->whereIn('secondary_category_id', Arr::wrap(request('secondary_category_id')));
        }
        if ($ids = request('support_ticket_tag_ids')) {
            foreach ($ids as $id) {
                $query->whereHas('supportTicketTagIds', function ($query) use ($id) {
                    $query->where('support_ticket_tags.id', $id);
                });
            }
        }

        return $query;
    }

    /*---------------------------------
    | Section : Modify row-columns
    |---------------------------------*/
    // /**
    //  * @param  \Yajra\DataTables\DataTableAbstract  $dt
    //  * @return mixed|\Yajra\DataTables\DataTableAbstract
    //  */
    public function modify($dt)
    {
        $dt = parent::modify($dt);

        if ($this->hasColumn('status_name')) {
            $dt->editColumn('status_name', function ($row) {
                $cssClass = 'status-'.Str::kebab(strtolower($row->status_name));

                return "<span class='badge block status-font-color $cssClass'>".$row->status_name."</span>";
            });
        }

        if ($this->hasColumn('support_ticket_tag_names')) {
            $dt->editColumn('support_ticket_tag_names', function ($row) {
                $html = '';
                if ($row->support_ticket_tag_names) {
                    /** @var SupportTicket $row */
                    foreach ($row->support_ticket_tag_names as $name) {
                        // $html .= "<span class='badge btn-default'>$name</span>";
                        $html .= ", $name";
                    }
                }

                return trim($html, ',');
            });
        }

        return $dt;
    }

    /*---------------------------------
    | Section : Additional methods
    |---------------------------------*/
    // public function query()
    // public function json()
    // public function hasColumn()
    // public function titles()
    // public function columnsJson()
    // public function ajaxUrl()
    // public function identifier()\
}

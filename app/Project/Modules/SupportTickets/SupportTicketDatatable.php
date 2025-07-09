<?php

namespace App\Project\Modules\SupportTickets;

class SupportTicketDatatable extends \App\Mainframe\Modules\SupportTickets\SupportTicketDatatable
{

    public $moduleName = 'support-tickets';

    /*---------------------------------
    | Section : Define query tables/model
    |---------------------------------*/
    // /**
    //  * @return \Illuminate\Database\Eloquent\Builder
    //  */
    // public function source() { return SupportTicket::with(['updater:id,name', 'supportTicketTagIds',]); }

    /*---------------------------------
    | Section : Define columns
    |---------------------------------*/
    // /**
    //  * @return array
    //  */
    // public function columns() { }

    /*---------------------------------
    | Section: SQL Select query
    |---------------------------------*/
    // /**
    //  * Construct SELECT statement (field1 AS f1, field2 as f2...)
    //  *
    //  * @return array
    //  */
    // public function selects() { }

    /*---------------------------------
    | Section: Filters
    |---------------------------------*/
    // /**
    //  * @param  \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed  $query
    //  * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed
    //  */
    // public function filter($query)
    // {
    //     $query = parent::filter($query);
    //     return $query;
    // }

    /*---------------------------------
    | Section : Modify row-columns
    |---------------------------------*/
    // /**
    //  * @param  \Yajra\DataTables\DataTableAbstract  $dt
    //  * @return mixed|\Yajra\DataTables\DataTableAbstract
    //  */
    // public function modify($dt)
    // {
    //     $dt = parent::modify($dt);
    //     return $dt;
    // }

    /*---------------------------------
    | Section : Additional methods
    |---------------------------------*/
    // public function query()
    // public function json()
    // public function hasColumn()
    // public function titles()
    // public function columnsJson()
    // public function ajaxUrl()
    // public function identifier()
}

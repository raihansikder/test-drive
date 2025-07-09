<?php

namespace App\Mainframe\Modules\SupportTickets;

use Arr;
use Str;
use App\Module;
use App\SupportTicket;
use Illuminate\Database\Eloquent\Builder;
use App\Project\Features\Report\ReportBuilder;
use App\Mainframe\Features\Report\Traits\ModuleReportBuilderTrait;

class SupportTicketReport extends ReportBuilder
{
    use ModuleReportBuilderTrait;

    public function __construct(Module $module)
    {
        $this->setModule(Module::byName('support-tickets'));
        $this->enableAutoRun();
        parent::__construct();
    }

    /**
     * Define the view blade for this report
     *
     * @return string
     */
    public function filterPath()
    {
        return projectKey().".modules.support-tickets.report.filter";
    }

    /**
     * @return string[]
     */
    public function selectedColumns()
    {
        $columns = ['id', 'name', 'primary_category_name', 'secondary_category_name', 'contact_no', 'status_name',];

        if (!in_array(request('ret'), ['excel', 'print'])) {
            $columns = array_merge($columns, ['support_ticket_tag_names']);
        } else {
            $columns = array_merge($columns, ['support_ticket_tag_names_formatted']);
        }

        return array_merge($columns, ['reviewers_note']);

    }

    /**
     * @return string[]
     */

    public function defaultColumns()
    {
        return
            [
                'id',
                'name',
                'primary_category_name',
                'secondary_category_name',
                'contact_no',
                'status_name',
                'support_ticket_tag_ids',
                'support_ticket_tag_names',
                'support_ticket_tag_names_formatted',
                'updated_by',
                'updated_at',
                'reviewers_note',
            ];
    }

    /**
     * @return string[]
     */

    public function aliasColumns()
    {
        $columns =
            [
                'ID',
                'Subject',
                'Primary Category',
                'Secondary Category',
                'Mobile No.',
                'Status',
                'Tags',
                "Reviewer's Note",
            ];

        return $columns;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function mutateResult()
    {
        $result = $this->result();

        foreach ($result as $row) {
            if (in_array('updated_by', $this->selectedColumns())) {
                $row->updated_by = optional($row->updater)->name;
            }
            if (in_array('updated_at', $this->selectedColumns())) {
                $row->updated_at = formatDateTime($row->updated_at);
            }
            if (in_array('status_name', $this->selectedColumns())) {
                $cssClass = 'status-'.Str::kebab(strtolower($row->status_name));
                $row->status_name = "<span class='badge block status-font-color $cssClass'>".$row->status_name."</span>";
            }
            if (in_array('support_ticket_tag_names', $this->selectedColumns())) {
                $html = '';
                if ($row->support_ticket_tag_names) {
                    /** @var SupportTicket $row */
                    foreach ($row->support_ticket_tag_names as $name) {
                        $html .= "<span class='badge btn-default'>$name</span>";
                    }
                }

                $row->support_ticket_tag_names = $html;
            }

        }

        return $result;
    }

    /**
     * @param $query
     * @return Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed
     */
    public function filter($query)
    {
        if ($vals = request('support_ticket_tag_ids')) {
            foreach ($vals as $val) {
                $query->whereHas('supportTicketTagIds', function ($q) use ($val) {
                    $q->where('support_ticket_tags.id', $val);
                });
            }
        }
        if ($val = request('status_name')) { // Example code
            $query->whereIn('status_name', Arr::wrap($val));
        }
        if ($val = request('primary_category_id')) { // Example code
            $query->whereIn('primary_category_id', Arr::wrap($val));
        }
        if ($val = request('secondary_category_id')) { // Example code
            $query->whereIn('secondary_category_id', Arr::wrap($val));
        }

        return $query;
    }
}

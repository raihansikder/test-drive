<?php
/**
 * @var \App\Mainframe\Features\Report\ReportBuilder $report
 * @var \Illuminate\Pagination\LengthAwarePaginator $result
 * @var int $total Total number of rows returned
 * @var \App\Mainframe\Features\Report\ReportViewProcessor $view
 */
?>
@section('css')
    @parent
    <style>
        .nav-tabs-custom > .tab-content {
            padding-bottom: 0
        }
    </style>
@stop

<form method="get">
    <div class="nav-tabs-custom report-filter-tabs">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_minimize" data-toggle="tab"><i class="fa fa-minus"></i></a></li>
            <li><a href="#tab_basic" data-toggle="tab">Filters</a></li>
            <li><a href="#tab_advanced" data-toggle="tab">Fields</a></li>
            <li class="pull-right">@include($report->ctaPath())</li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_minimize">
                @include('form.text',['var'=>['name'=>'report_name','label'=>'Report name', 'div'=>'col-sm-10','val'=>urldecode(request('report_name'))]])
                @include('form.select-array',['var'=>['name'=>'rows_per_page','label'=>'Rows per page','options'=>kv([10,25,50,100]),'div'=>'pull-right col-md-2']])
            </div>
            <div class="tab-pane" id="tab_basic">
                <?php
                $levels = [
                    [
                        'name' => 'primary_category_id',
                        'label' => 'Primary Category',
                        'model' => \App\SupportTicketCategory::class,
                        'query' => \App\SupportTicketCategory::where('parent_id', 0),
                        'url_param' => 'parent_id',
                    ],
                    [
                        'name' => 'secondary_category_id',
                        'label' => 'Secondary Category',
                        'model' => \App\SupportTicketCategory::class,
                    ],
                ]
                ?>
                @include('form.select-model-chained',['levels'=>$levels])
                @include('form.select-array-multiple',['var'=>['name'=>'status_name','label'=>'Status','div'=>'col-md-2','class'=>'select2','options'=>kv(\App\SupportTicket::$statusOptions)]])

                <?php
                $var = [
                    'name' => 'support_ticket_tag_ids',
                    'label' => 'Tags',
                    'model' => new \App\SupportTicketTag, // Todo: demo implementation shown with group
                    'name_field' => 'name',
                    'div' => 'col-sm-4',
                    'class' => 'select2',
                    'data_attributes' => ['name']
                ];
                ?>
                @include('form.select-model-multiple', compact('var'))
            </div>

            <div class="tab-pane" id="tab_advanced">
                @include($report->advancedFilterPath())
            </div>
            <!-- Make sure this clear div is added -->
            <div class="clearfix"></div>
        </div>

        <div class="clearfix"></div>

    </div>
</form>

@section('js')
    @parent
@endsection

@extends('project.layouts.default.template')
<?php
/**
 * @var  \App\Project\Modules\SupportTickets\SupportTicketDatatable $datatable
 * @var \App\Module $module
 * @var array $columns
 * @var \App\Project\Modules\SupportTickets\SupportTicketViewProcessor $view
 */

$datatable = $datatable ?? $view->datatable;
$titles = $datatable->titles();
$columnsJson = $datatable->columnsJson();
$ajaxUrl = $datatable->ajaxUrl();
$datatableName = $datatable->name();
?>
@section('title')
    @include('project.layouts.module.grid.includes.title')
@endsection

@section('content')
    <div class="{{$datatableName}}-container datatable-container">
        <div class="filters col-md-12 no-padding">
            <form name="{{$datatableName}}FilterForm" id="{{$datatableName}}FilterForm">
                <div class="col-md-12 no-padding-l">
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
                    @include('form.select-array-multiple',['var'=>['name'=>'status_name','label'=>'Status','div'=>'col-md-3','class'=>'select2','options'=>kv(\App\SupportTicket::$statusOptions)]])
                    <?php
                    $var = [
                        'name' => 'support_ticket_tag_ids',
                        'label' => 'Tags',
                        'model' => new \App\SupportTicketTag,
                        'name_field' => 'name',
                        'div' => 'col-md-3',
                        'class' => 'select2',
                        'data_attributes' => ['name']
                    ];
                    ?>
                    @include('form.select-model-multiple', compact('var'))
                </div>

            </form>
        </div>
        <table id="{{$datatableName}}"
               class="table module-grid table-condensed {{$datatableName}} dataTable table-hover"
               style="width: 100%">
            <thead>
            <tr>
                @foreach($titles as $title)
                    <th>{!! $title !!}</th>
                @endforeach
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $('#division_id,#district_id').select2();
        var {{$datatableName}} = $('#{{$datatableName}}').DataTable({
            ajax: {
                url: "{!! $ajaxUrl !!}",
                data: function (d) {
                    d.primary_category_id = $('#primary_category_id').val();
                    d.secondary_category_id = $('#secondary_category_id').val();
                    d.status_name = $('#status_name').val();
                    d.support_ticket_tag_ids = $('#support_ticket_tag_ids').val();

                }
            },
            columns: [{!! $columnsJson !!}],
            processing: true,
            serverSide: true,
            searchDelay: {!! $datatable->searchDelay() !!}, // Search delay
            minLength: {!! $datatable->minLength() !!},     // Minimum characters to be typed before search begins
            lengthMenu: {!! $datatable->lengthMenu() !!},
            pageLength: {!! $datatable->pageLength()!!},
            order: {!! $datatable->order()!!},              // First row descending
            bLengthChange: {!! $datatable->bLengthChange() !!}, // show the length field
            bPaginate: {!! $datatable->bPaginate() !!},
            bFilter: {!! $datatable->bFilter() !!},
            bInfo: {!! $datatable->bInfo() !!},
            bDeferRender: {!! $datatable->bDeferRender() !!},
            "dom": 'Blftipr',                               // Special code to load dom element. i.e. B=buttons
            "buttons": [
                {
                    className: 'dt-refresh-btn btn btn-sm btn-default pull-left bg-white form-control input-sm',
                    text: '<ion-icon class="dt-reload" name="reload"></ion-icon>',
                    action: function (e, dt, node, config) {
                        dt.draw();
                    }
                }
            ],
            mark: true // Mark/highlight the search results (in yellow)
        });


        /*---------------------------------
        | Detect changes and re-draw table
        |---------------------------------*/

        $('#primary_category_id,#secondary_category_id,#status_name,#support_ticket_tag_ids').on('change blur', function () {
            {{$datatableName}}.draw();
            buildReportUrl();
        });

        // Step.3.2 Catch filter input change event and refresh datatable
        $('#{{$datatableName}}FilterForm .submit-btn').on('click', function () {
            {{$datatableName}}.draw();
            buildReportUrl();
        });

        // Step.4 Reset the filters and reset datatable
        $('#{{$datatableName}}ResetBtn').on('click', function () {
            $('#{{$datatableName}}FilterForm select').select2('val', '');
            $('#{{$datatableName}}FilterForm #status_name').prop('selectedIndex', -1);
            $('#{{$datatableName}}FilterForm text').val('');
            $('#{{$datatableName}}FilterForm input').val('');
            {{$datatableName}}.draw();
            buildReportUrl();
        })

        /**
         * Build the default module report URL based on selected parameters
         */
        function buildReportUrl() {
            var params = $('#{{$datatableName}}FilterForm').serialize();
            var reportUrl = "{{route('support-tickets.report')}}" + '?' + params;
            $('a.module-report-btn').attr('href', reportUrl);
        }

    </script>
    @parent
@endsection

@unset($datatable)

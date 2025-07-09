@extends('project.layouts.default.template')

<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var array $immutables
 * @var \App\SystemEvent $element
 * @var \App\SystemEvent $systemEvent
 * @var \App\Project\Modules\SystemEvents\SystemEventViewProcessor $view
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
    {{-- Section: Filters --}}
    <div class="row">
        <div class="col-md-12">
            <form id="{{$datatableName}}FilterForm">

                {{-- Code:Date range picker--}}
                {{-- Hidden value for date range picker--}}
                {{-- https://www.daterangepicker.com/ Todo:Need to take to blade date-range.blade.php--}}
                @include('form.hidden',['var'=>['name'=>'occurred_at_from', 'class'=>'filter-input']])
                @include('form.hidden',['var'=>['name'=>'occurred_at_till', 'class'=>'filter-input']])
                <button type="button" class="btn btn-default align-with-input" id="daterange-btn">
                    <span>Date range - All</span>
                    <i class="fa fa-caret-down"></i>
                </button>
                {{--  --------------------- --}}

                @include('form.select-array-multiple',['var'=>['name'=>'type','label'=>'Type','div'=>'col-md-3','class'=>'filter-input','options'=>kv(\App\SystemEvent::$types)]])
                @include('form.select-array-multiple',['var'=>['name'=>'source','label'=>'Source','div'=>'col-md-3','class'=>'filter-input','options'=>kv(\App\SystemEvent::$sources)]])
                @include('form.select-array-multiple',['var'=>['name'=>'environment','label'=>'Environment','div'=>'col-md-3','class'=>'filter-input','options'=>kv(\App\SystemEvent::$envs)]])
                <div class="clearfix"></div>
                @include('form.select-model-multiple',['var'=>['name'=>'user_id','label'=>'User','div'=>'col-md-3','model'=>\App\User::class,'class'=>'filter-input']])
                @include('form.select-model-multiple',['var'=>['name'=>'module_id','label'=>'Module','div'=>'col-md-3','model'=>\App\Module::class,'class'=>'filter-input','name_field'=>'title']])
                @include('form.tags',['var'=>['name'=>'tags','label'=>'Tags(Add any)', 'class'=>'filter-input', 'div'=>'col-md-3']])

                <div class="btn-group align-with-input">
                    <button class="btn btn-default btn-transparent submit-btn" type="button">Filter</button>
                    <button class="btn btn-default btn-transparent reset-btn" type="button">Reset</button>
                </div>

            </form>
        </div>
    </div>

    {{-- Section: Datatable --}}
    <div class="{{$datatableName}}-container datatable-container table-responsive">
        <table id="{{$datatableName}}"
               class="table-{{$datatableName}} table module-grid table-condensed dataTable table-hover table-responsive">
            <thead>
            <tr>
                @foreach($titles as $title)
                    <th>{!! $title !!}</th>
                @endforeach
            </tr>
            </thead>
            {{-- Note: Table body will be added by the dataTable JS --}}
        </table>
    </div>
@endsection

@section('js')
    <script>
        //http://www.daterangepicker.com/
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment(),
                endDate: moment(),
                locale: {cancelLabel: 'Clear'}
            },
            function (start, end) {
                $('#occurred_at_from').val(start.format('YYYY-MM-DD')); // Assign SQL native date format in hte hidden field
                $('#occurred_at_till').val(end.format('YYYY-MM-DD'));
                $('#daterange-btn span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
            }
        );
    </script>

    @if(Request::get('occurred_at_from') && Request::get('occurred_at_till'))
        <script>
            //Date range will be shown as per the given inputs
            var date_from = "{{date_create(Request::get('occurred_at_from'))->format('Y-m-d')}}";
            var date_from_object = new Date(date_from);
            var formatted_date_from = (date_from_object.getMonth() + 1) + "/" + date_from_object.getDate() + "/" + date_from_object.getFullYear();

            var date_to = "{{date_create(Request::get('occurred_at_till'))->format('Y-m-d')}}";
            var date_to_object = new Date(date_to);
            var formatted_date_to = (date_to_object.getMonth() + 1) + "/" + date_to_object.getDate() + "/" + date_to_object.getFullYear();

            $('#daterange-btn').data('daterangepicker').setStartDate(formatted_date_from);
            $('#daterange-btn').data('daterangepicker').setEndDate(formatted_date_to);
        </script>
    @endif
    <script type="text/javascript">

        // Step.1 Enable Select2
        $('#{{$datatableName}}FilterForm select').select2();

        var {{$datatableName}} = $('#{{$datatableName}}').DataTable({
            ajax: {
                url: "{!! $ajaxUrl !!}",
                data: function (d) {
                    d.type = $('#{{$datatableName}}FilterForm #type').val();
                    d.environment = $('#{{$datatableName}}FilterForm #environment').val();
                    d.source = $('#{{$datatableName}}FilterForm #source').val();
                    d.user_id = $('#{{$datatableName}}FilterForm #user_id').val();
                    d.module_id = $('#{{$datatableName}}FilterForm #module_id').val();
                    d.tags = $('#{{$datatableName}}FilterForm #tags').val();
                    d.occurred_at_from = $('#{{$datatableName}}FilterForm #occurred_at_from').val();
                    d.occurred_at_till = $('#{{$datatableName}}FilterForm #occurred_at_till').val();

                }
            },
            columns: [{!! $columnsJson !!}],
            processing: {!! $datatable->processing() !!},
            serverSide: {!! $datatable->serverSide() !!},
            searchDelay: {!! $datatable->searchDelay() !!},
            minLength: {!! $datatable->minLength() !!},
            lengthMenu: {!! $datatable->lengthMenu() !!},
            pageLength: {!! $datatable->pageLength()!!},
            order: {!! $datatable->order()!!},
            bLengthChange: {!! $datatable->bLengthChange() !!},
            bPaginate: {!! $datatable->bPaginate() !!},
            bFilter: {!! $datatable->bFilter() !!},
            bInfo: {!! $datatable->bInfo() !!},
            bDeferRender: {!! $datatable->bDeferRender() !!},
            "dom": '{!! $datatable->dom() !!}',
            "buttons": [
                {
                    className: 'dt-refresh-btn btn btn-sm btn-default pull-left bg-white form-control input-sm',
                    text: '<ion-icon class="dt-reload" name="reload"></ion-icon>',
                    action: function (e, dt, node, config) {
                        dt.draw();
                    }
                }
            ],
            mark: {!! $datatable->mark() !!} // Mark/highlight the search results (in yellow)
        });


        /*---------------------------------
        | Detect changes and re-draw table
        |---------------------------------*/

        // Step.3.1 Catch filter input change event and refresh datatable
        $('#{{$datatableName}}FilterForm .filter-input').on('change blur', function () {
            {{$datatableName}}.draw();
            {{$datatableName}}buildReportUrl();
        });

        // Step.3.2 Catch filter input change event and refresh datatable
        $('#{{$datatableName}}FilterForm .submit-btn').on('click', function () {
            {{$datatableName}}.draw();
            {{$datatableName}}buildReportUrl();
        });

        // Step.4 Reset the filters and reset datatable
        $('#{{$datatableName}}FilterForm .reset-btn').on('click', function () {
            $('#{{$datatableName}}FilterForm select').select2('val', '');
            $('#{{$datatableName}}FilterForm text').val('');
            $('#{{$datatableName}}FilterForm input').val('');
            $('#{{$datatableName}}FilterForm #ajax_select2_input_id').prop('selectedIndex', -1);
            $('#{{$datatableName}}FilterForm #environment,#source,#type').prop('selectedIndex', -1);
            {{$datatableName}}.draw();
            {{$datatableName}}buildReportUrl();
        })

        /**
         * Build the default module report URL based on selected parameters
         */
        function {{$datatableName}}buildReportUrl() {
            var params = $('#{{$datatableName}}FilterForm').serialize();
            var reportUrl = '{!! route($module->name.'.report') !!}' + '?' + params;
            $('a.module-report-btn').attr('href', reportUrl);
        }

        /*
        |--------------------------------------------------------------------------
        | Handle date-range picker events
        |--------------------------------------------------------------------------
        */
        $('#daterange-btn').on('apply.daterangepicker', function (ev, picker) {
            {{$datatableName}}.draw();
        }).on('cancel.daterangepicker', function (ev, picker) {
            //do something, like clearing an input
            $('#occurred_at_from,#occurred_at_till').val('');
            $('#daterange-btn span').html('Date range - All');
            {{$datatableName}}.draw();
        });

    </script>
    @parent
@endsection

@unset($datatable)

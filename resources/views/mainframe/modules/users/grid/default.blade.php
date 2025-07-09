@extends('project.layouts.default.template')

<?php
/**
 * Variables
 * @var \App\Project\Modules\Users\UserDatatable $datatable
 * @var \App\Module $module
 * @var array $columns
 * @var \App\Project\Features\Core\ViewProcessor $view
 */
$datatable = $datatable ?? $view->datatable;
$titles = $datatable->titles();
$columnsJson = $datatable->columnsJson();
$ajaxUrl = $datatable->ajaxUrl();
$datatableName = $datatable->name();
?>

@section('sidebar-left')
    @include('project.layouts.default.includes.navigation.left-menu.menu-items')
@endsection

@section('title')
    @include('project.layouts.module.grid.includes.title')
@endsection

@section('content')
    {{-- Section: Filters --}}
    @if($datatable->showCustomFilter())
        <div class="row">
            <div class="col-md-12">
                <form id="{{$datatableName}}FilterForm">
                    @include('form.select-model-multiple',['var'=>['name'=>'group_id','label'=>'Group', 'model'=>\App\Group::class, 'name_field'=>'title', 'class'=>'filter-input']])
                    {{-- Code:Date range picker--}}
                    @include('mainframe.form.date-range',['var'=>['name'=>'created_at','label'=>'Created At']])
                    {{-- @include('form.text',['var'=>['name'=>'name','label'=>'Name', 'class'=>'filter-input']])--}}
                    
                    <div class="btn-group align-with-input">
                        <button class="btn btn-default btn-bordered-blue submit-btn" type="button">Filter</button>
                        <button class="btn btn-default btn-bordered-blue reset-btn" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    
    {{-- Section: Datatable --}}
    
    <div class="row">
        <div class="col-md-12">
            <div class="{{$datatable->containerClass()}}">
                <table id="{{$datatableName}}" class="{{$datatable->tableClass()}}">
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
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">

        // Step.1 Enable Select2
        $('#{{$datatableName}}FilterForm select').select2();

        // Step.2 Init datatable
        var {{$datatableName}} = $('#{{$datatableName}}').DataTable({
            ajax: {
                url: "{!! $ajaxUrl !!}",
                data: function (d) { // Step.2.1 Define AJAX data. Properly target to avoid conflict with other element in form
                    d.name = $('#{{$datatableName}}FilterForm #name').val();
                    d.group_id = $('#{{$datatableName}}FilterForm #group_id').val();
                    d.created_at_from = $('#{{$datatableName}}FilterForm #created_at_from').val(); // From date-range picker
                    d.created_at_till = $('#{{$datatableName}}FilterForm #created_at_till').val(); // From date-range picker
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
            $('#{{$datatableName}}FilterForm .date-range-picker').html('-');
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
        | Step.4.1 Handle date-range picker events (apply, cancel button click)
        |--------------------------------------------------------------------------
        */
        $('.date-range-picker').on('apply.daterangepicker cancel.daterangepicker', function (ev, picker) {
            {{$datatableName}}.draw();
        });
    </script>
    @parent
@endsection

@unset($datatable)

@extends('project.layouts.default.template')
<?php
/**
 * @var  \App\Project\Modules\Upazilas\UpazilaDatatable $datatable
 * @var \App\Module $module
 * @var array $columns
 * @var \App\Project\Modules\Upazilas\UpazilaViewProcessor $view
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

    <div class="row">
        <div class="col-md-12">
            <form id="{{$datatableName}}FilterForm">
                <?php
                $levels = [
                    [
                        'name' => 'division_id',
                        'label' => 'Division',
                        'model' => \App\Division::class,
                        'class' => 'filter-input'
                    ],
                    [
                        'name' => 'district_id',
                        'label' => 'District',
                        'model' => \App\District::class,
                        'class' => 'filter-input'
                    ],
                ];
                ?>
                @include('mainframe.form.select-model-chained-multiple',['levels'=>$levels])

                <div class="btn-group align-with-input pull-left">
                    <button class="btn btn-default btn-transparent submit-btn" type="button">Submit</button>
                    <button class="btn btn-default btn-transparent reset-btn" type="button">Reset</button>
                </div>
            </form>
        </div>
    </div>

    <div class="{{$datatableName}}-container datatable-container table-responsive">
        <table id="{{$datatableName}}"
               class="table module-grid table-condensed {{$datatableName}} dataTable table-hover">
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
                    d.division_id = $('#{{$datatableName}}FilterForm #division_id').val();
                    d.district_id = $('#{{$datatableName}}FilterForm #district_id').val();
                }
            },
            columns: [{!! $columnsJson !!}],
            processing: {!! $datatable->processing() !!},
            serverSide: {!! $datatable->serverSide() !!},
            searchDelay: {!! $datatable->searchDelay() !!}, // Search delay
            minLength: {!! $datatable->minLength() !!}, // Minimum characters to be typed before search begins
            lengthMenu: {!! $datatable->lengthMenu() !!},
            pageLength: {!! $datatable->pageLength()!!},
            order: {!! $datatable->order()!!}, // First row descending
            bLengthChange: {!! $datatable->bLengthChange() !!}, // show the length field
            bPaginate: {!! $datatable->bPaginate() !!},
            bFilter: {!! $datatable->bFilter() !!},
            bInfo: {!! $datatable->bInfo() !!},
            bDeferRender: {!! $datatable->bDeferRender() !!},
            "dom": '{!! $datatable->dom() !!}', // Special code to load dom element. i.e. B=buttons
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
        {{-- {{$datatableName}}.buttons().container().appendTo('.dataTables_length');--}}

        /*
        |--------------------------------------------------------------------------
        | Datatable redraw and reset events on ipnut interaction
        |--------------------------------------------------------------------------
        */
        // Step.3.1 Catch filter input change event and refresh datatable
        $('#{{$datatableName}}FilterForm .filter-input').on('change blur', function () {
            {{$datatableName}}redraw();
        });

        // Step.3.2 Catch filter input change event and refresh datatable
        $('#{{$datatableName}}FilterForm .submit-btn').on('click', function () {
            {{$datatableName}}redraw();
        });

        // Step.4 Reset the filters and reset datatable
        $('#{{$datatableName}}FilterForm .reset-btn').on('click', function () {
            resetDatatableFilter('{{$datatableName}}FilterForm');
            $('#{{$datatableName}}FilterForm #some_id').prop('selectedIndex', -1); // For Ajax loaded select2 fields
            {{$datatableName}}redraw();
        })

        /*
        |--------------------------------------------------------------------------
        | datatable helper functions
        |--------------------------------------------------------------------------
        */

        /**
         * Redraw datatable and handle actions on redraw. i.e. Building report URL
         */
        function {{$datatableName}}redraw() {
            {{$datatableName}}.draw();  // Redraw datatable through fresh ajax call
            {{$datatableName}}buildReportUrl(); // Builds report url in a default module grid
        }

        /**
         * Build report URL based on selected filter input
         */
        function {{$datatableName}}buildReportUrl() {
            buildReportUrlFromFilterParams(
                '{{$datatableName}}FilterForm',
                '{!! $datatable->module ? route($datatable->module->name.'.report') : '/'!!}',
                'module-report-btn'
            );
        }

        /**
         * todo : implementation
         * Step.5 Build report link based on filter selection.
         * Build the default module report URL based on selected parameters
         */
        {{-- function {{$datatableName}}buildReportUrl() { --}}
        {{--     // Note: Update the logic as necessary --}}
        {{--     var params = $('#{{$datatableName}}FilterForm').serialize(); --}}
        {{--     // Use your specific route --}}
        {{--     @if($datatable->module) --}}
        {{--     var reportUrl = '{!! route($datatable->module->name.'.report') !!}' + '?' + params; --}}
        {{--     @endif --}}
        {{--     $('a.module-report-btn').attr('href', reportUrl); --}}
        {{-- } --}}


    </script>
    @parent
@endsection

@unset($datatable)

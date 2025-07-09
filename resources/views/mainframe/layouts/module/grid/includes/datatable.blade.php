<?php

/**
 * Variables
 * @var \App\Mainframe\Features\Datatable\Datatable $datatable
 * @var \App\Module $module
 * @var array $columns
 * @var \App\Mainframe\Features\Core\ViewProcessor $view
 */
$datatable = $datatable ?? $view->datatable;
$titles = $datatable->titles();
$columnsJson = $datatable->columnsJson();
$ajaxUrl = $datatable->ajaxUrl();
$datatableName = $datatable->name();
?>

{{-- Section:Filters --}}
@if($datatable->showCustomFilter())
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <form id="{{$datatableName}}FilterForm">--}}
{{--                @include('form.text',['var'=>['name'=>'field','label'=>'Field','div'=>'col-md-2', 'class'=>'filter-input']])--}}
{{--                <div class="btn-group align-with-input pull-left">--}}
{{--                     <button class="btn btn-default btn-transparent submit-btn" type="button">Submit</button>--}}
{{--                    <button class="btn btn-default btn-transparent reset-btn" type="button">Reset</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
@endif

<!-- Section:Table -->
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

{{--
Section:JS
We are using and older version of datatable here that instantiates using 'dataTable'. The newer version
can be initialized using 'Datatable' (Capital D). The newer version should be used for custom datatables.
For this olderversion we are using fnSetFilteringDelay(2000) for the inital search delay.
--}}

@section('js')
    <script type="text/javascript">
        // Step.1 Instantiate Datatable
        var {{$datatableName}} = $('#{{$datatableName}}').DataTable({
            ajax: {
                url: "{!! $ajaxUrl !!}",
                data: function (d) { // Step.2 Catch your filter values and send to BE
                    // d.facility_id = $('#{{$datatableName}}FilterForm #facility_id').val();
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
        | Datatable redraw and reset events on input interaction
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
        | Datatable helper functions
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
    </script>
    @parent
@endsection

@unset($datatable,$titles,$columnsJson,$ajaxUrl,$datatableName)

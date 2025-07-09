@extends('project.layouts.default.template')

<?php
/**
 * @var  \App\Project\Modules\Districts\DistrictDatatable $datatable
 * @var \App\Module $module
 * @var array $columns
 * @var \App\Project\Modules\Districts\DistrictViewProcessor $view
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
            @include('form.select-model-multiple',['var'=>['name'=>'division_ids','label'=>'Division','model'=>\App\Division::class,'class'=>'select2']])
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
        $('#division_ids').select2();
        var {{$datatableName}} = $('#{{$datatableName}}').DataTable({
            ajax: {
                url: "{!! $ajaxUrl !!}",
                data: function (d) {
                    d.division_id = $('#division_ids').val();
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
            mark: true // Mark/highlight the search selections (in yellow)
        });

        {{$datatableName}}.buttons().container().appendTo('.dataTables_length');

        /*---------------------------------
        | Detect changes and re-draw table
        |---------------------------------*/
        $('#division_ids').on('change blur', function () {
            {{$datatableName}}.draw();
        });
    </script>
    @parent
@endsection

@unset($datatable)

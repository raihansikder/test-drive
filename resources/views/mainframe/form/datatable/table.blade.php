<?php
/**
 * Variables
 *
 * @var \App\Mainframe\Features\Datatable\Datatable $datatable
 */

?>
<div class="clearfix"></div>

<div class="{{$datatable->containerClass()}}">
    <table id="{{$datatable->name()}}" class="{{$datatable->tableClass()}}">
        <thead>
        <tr>
            @foreach($datatable->titles() as $title)
                <th>{!! $title !!}</th>
            @endforeach
        </tr>
        </thead>
        {{-- Note: Table body will be added by the dataTable JS --}}
    </table>
</div>

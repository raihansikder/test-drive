<?php

/**
 * @var \App\Mainframe\Features\Datatable\Datatable $datatable
 */
$class = $class ?? '';
?>
<div class="clearfix"></div>
<div class="btn-group {{$class}}">
    @if($datatable->filterOnSubmit())
        <button class="btn btn-primary submit-btn" type="button">Filter</button>
    @endif
    @if($datatable->showFilterResetBtn())
        <button class="btn btn-default  reset-btn" type="reset">Reset</button>
    @endif
</div>

@unset($class)
<?php
/** @var \App\Project\Features\Modular\BaseModule\BaseModuleViewProcessor $view */
?>
<span class="grid-title">{{$view->gridTitle()}}</span>

@if($view->show('form-create-btn'))
    <a href="{!! $view->createBtnUrl() !!}" data-toggle="tooltip" title="{!! $view->createBtnTooltip() !!}"
       class="btn module-create-btn btn-bordered-smart-red {{$module->name.'-module-create-btn'}}">
        <i class="fi fi-rr-plus"></i> {{$view->createBtnText()}}</a>
@endif

@if($view->show('report-link'))
    <a href="{!! $view->reportBtnUrl() !!}" title={!! $view->reportBtnTooltip() !!}data-toggle="tooltip" target="_blank"
       class="btn pull-right module-report-btn {{$module->name.'-module-list-btn'}} btn-bordered-smart-red">
        <i class="fi fi-rr-table-list"></i> Report</a>
@endif

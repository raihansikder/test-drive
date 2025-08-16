<?php
/** @var \App\Mainframe\Features\Modular\BaseModule\BaseModuleViewProcessor $view */
?>

{{$view->formTitle()}}

{{-- Show create button --}}
@if($view->show('form-create-btn'))
    <a class="btn btn-xs module-create-btn {{$module->name.'-module-create-btn'}}"
       href="{!! $view->createBtnUrl() !!}" data-toggle="tooltip"
       title="Create a new {{lcfirst(Str::singular($module->title))}}">
        <i class="fi fi-rr-plus"></i>
    </a>
@endif

{{-- Show list(index) button --}}
@if($view->show('form-list-btn'))
    <a class="btn btn-xs module-list-btn {{$module->name.'-module-list-btn'}}"
       href="{!! $view->listBtnUrl() !!}" data-toggle="tooltip"
       title="View list of {{lcfirst(Str::plural($module->title))}}">
        <i class="fa fa-list"></i>
    </a>
@endif

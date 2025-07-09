<?php
/**
 * This blade is included in the module form
 *
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModuleViewProcessor $view
 * @var \App\Module $module
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $element
 */
?>

{{-- Show create button --}}
@if($view->showFormCreateBtn() && $element->isUpdating())
    <a href="{!! $view->createBtnUrl() !!}" class="btn btn-xs module-create-btn {{$module->name.'-module-create-btn'}}"
       data-toggle="tooltip" title="{!! $view->createBtnTooltip() !!}">
        <i class="fa fa-plus"></i></a>
@endif

{{-- Show list(index) button --}}
@if($view->showFormListBtn())
    <a href="{!! $view->listBtnUrl() !!}" class="btn btn-xs module-list-btn {{$module->name.'-module-list-btn'}}"
       data-toggle="tooltip" title="{!! $view->listBtnTooltip() !!}">
        <i class="fa fa-list"></i></a>
@endif

{{-- Show title --}}
<span class="form-title">{{$view->formTitle()}}</span>

@if($view->showCloneBtn())
    @include('mainframe.layouts.default.includes.navigation.clone')
@endif

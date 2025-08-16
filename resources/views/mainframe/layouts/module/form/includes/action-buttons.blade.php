<?php

/**
 * @var \App\Module $module
 * @var \App\Mainframe\Modules\SuperHeroes\SuperHero $element
 * @var \App\Project\Features\Core\ViewProcessor $view
 */
$float = $float ?? true;
?>

@section('css')
    @parent
    @if(!$float)
        <style>
            .delete-cta {
                margin-right: 0;
            }

            .cta-block {
                position: relative;
                border-top: none;
                box-shadow: none;
            }
        </style>
    @endif
@endsection


<div id="{{$module->route_name}}CtaBlock" class="cta-block no-margin col-md-12">

    {{--  Save button --}}
    @include('mainframe.layouts.module.form.includes.hidden')

    @if($view->showDefaultFormSaveBtn())
        <button id="{{$module->name}}SubmitBtn" type="submit" class="{!! $view->defaultFormSaveBtnClass() !!}">
            {!!  $view->defaultFormSaveBtnText()  !!}
        </button>
    @endif

    @if($view->showDefaultFormTimeStamps())
        @include('mainframe.layouts.module.form.includes.stamps')
    @endif

    {{-- Delete modal open button--}}
    @if($view->showDefaultFormDeleteBtn())
        @include('mainframe.layouts.module.form.includes.delete-btn')
    @endif

    {{--  Change log button --}}
    @if($view->showDefaultFormChangeLogBtn())
        @include('mainframe.layouts.module.form.includes.change-log-btn')
    @endif
</div>

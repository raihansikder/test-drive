@extends('mainframe.layouts.module.form.template')
<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var array $immutables
 * @var \App\Spread $element
 * @var \App\Spread $spread
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\Spreads\SpreadViewProcessor $view
 */
$spread = $element;
?>

@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">
            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            {{---------------|  Form input start |-----------------------}}
            @include('form.text',['var'=>['name'=>'name','label'=>'Name']])
                <div class="clearfix"></div>
            @include('form.is-active')
            {{---------------|  Form input start |-----------------------}}

            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.spreads.form.js')
@endsection

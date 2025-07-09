@extends('project.layouts.module.form.template')
<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var array $immutables
 * @var \App\Project $element
 * @var \App\Project $project
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\Projects\ProjectViewProcessor $view
 */
$project = $element;
?>

@section('content')
    <div class="col-md-12 no-padding">
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
@endsection

@section('js')
    @parent
    @include('project.modules.projects.form.js')
@endsection

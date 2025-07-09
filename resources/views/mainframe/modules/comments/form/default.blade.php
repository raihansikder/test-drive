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
 * @var \App\Comment $element
 * @var \App\Comment $comment
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\Comments\CommentViewProcessor $view
 */
$comment = $element;
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
            @include('form.text',['var'=>['name'=>'name','label'=>'Name','div'=>'col-md-6']])
            <div class="clearfix"></div>
            @include('form.textarea',['var'=>['name'=>'body','label'=>'Comment Body']])
            <div class="clearfix"></div>
            @include('form.select-model',['var'=>['name'=>'module_id','label'=>'Module','model'=>App\Module::class,'class'=>'select2','show_inactive'=>true]])
            @include('form.plain-text',['var'=>['name'=>'element_id','label'=>'Element']])
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
    @include('mainframe.modules.comments.form.js')
@endsection

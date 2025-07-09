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
 * @var \App\Content $element
 * @var \App\Content $content
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\Contents\ContentViewProcessor $view
 */
$content = $element;
?>
@section('css')
    @parent
    <style>
        #partsTable {
            margin-bottom: 0;
        }

        #partsTable > tbody > tr > td {
            border-top: 0;
        }
    </style>
@endsection

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
            @include('form.text',['var'=>['name'=>'key','label'=>'Key <code>key-format</code>']])
            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'title','label'=>'Title', 'div'=>'col-md-12']])
            @include('form.textarea',['var'=>['name'=>'body','label'=>'Body', 'div'=>'col-md-12']])


            @include('form.tags',['var'=>['name'=>'tags','label'=>'Tags', 'tags'=>\App\Spread::tags(), 'div'=>'col-md-12']])
                <div class="clearfix"></div>
                @include('form.is-active')
            {{---------------|  Form input start |-----------------------}}

            @include('mainframe.form.parts', ['var'=>['name' => 'parts', 'label' => 'Parts',]])
            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('content-bottom')
    @parent
    <div class="col-md-6 no-padding-l">
        <h5>File upload</h5><small>Upload one or more files</small>
        @include('form.uploads',['var'=>['limit'=>99,'bucket'=>'public/'.$module->name]])
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.contents.form.js')
@endsection

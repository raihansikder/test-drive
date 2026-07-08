@extends('project.layouts.module.form.template')
<?php

use App\Module;
use App\ModuleGroup;
use App\Project\Modules\ModuleGroups\ModuleGroupViewProcessor;
use App\Tenant;
use App\User;

/**
 * @var Module $module
 * @var User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var array $immutables
 * @var ModuleGroup $element
 * @var ModuleGroup $moduleGroup
 * @var Tenant $tenant
 * @var ModuleGroupViewProcessor $view
 */
$moduleGroup = $element;
?>

@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">

            @if($formState === 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState === 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif
                {{--    Form inputs: starts    --}}
                {{--   --------------------    --}}
                @include('form.text',['var'=>['name'=>'title','label'=>'Title','div'=>'col-md-6']])
                {{-- @include('form.text',['var'=>['name'=>'name','label'=>'Name (singular-camel-case)']])--}}
                @include('form.select-model',['var'=>['name'=>'parent_id','label'=>'Parent module', 'table'=>'modules','div'=>'col-md-6']])
                @include('form.text',['var'=>['name'=>'order','label'=>'Order','div'=>'col-md-3']])
                @include('form.text',['var'=>['name'=>'level','label'=>'Level','div'=>'col-md-3']])
                @include('form.text',['var'=>['name'=>'color_css','label'=>'Color CSS','div'=>'col-md-6']])
                @include('form.text',['var'=>['name'=>'icon_css','label'=>'Icon CSS/HTML','div'=>'col-md-12']])
                {{-- @include('form.text',['var'=>['name'=>'default_route','label'=>'Default Route','div'=>'col-md-12']])--}}

                <div class="clearfix"></div>
                @include('form.textarea',['var'=>['name'=>'description','params'=>['class'=>'ckeditor'],'label'=>'Description', 'div'=>'col-sm-12']])


                <div class="clearfix"></div>
                @include('form.checkbox',['var'=>['name'=>'is_visible','label'=>'Visible','div'=>'col-md-3 bordered-checkbox']])
                @include('form.is-active')
                {{--    Form inputs: ends    --}}

                @include('form.action-buttons')
            {{ Form::close() }}

        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.module-groups.form.js')
@endsection

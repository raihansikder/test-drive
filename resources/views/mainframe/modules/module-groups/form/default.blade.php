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
 * @var \App\ModuleGroup $element
 * @var \App\ModuleGroup $moduleGroup
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\ModuleGroups\ModuleGroupViewProcessor $view
 */
$moduleGroup = $element;
?>

@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">

            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif
            <div class="row">
                {{--    Form inputs: starts    --}}
                {{--   --------------------    --}}
                @include('form.text',['var'=>['name'=>'title','label'=>'Title']])
                @include('form.text',['var'=>['name'=>'name','label'=>'Name (singular-camel-case)']])
                @include('form.select-model',['var'=>['name'=>'parent_id','label'=>'Parent module', 'table'=>'modules']])
                @include('form.text',['var'=>['name'=>'order','label'=>'Order']])
                @include('form.text',['var'=>['name'=>'level','label'=>'Level']])
                @include('form.text',['var'=>['name'=>'color_css','label'=>'Color CSS']])
                @include('form.text',['var'=>['name'=>'icon_css','label'=>'Icon CSS/HTML']])
                @include('form.text',['var'=>['name'=>'default_route','label'=>'Default Route']])

                <div class="clearfix"></div>
                @include('form.textarea',['var'=>['name'=>'description','params'=>['class'=>''],'label'=>'Description', 'div'=>'col-sm-6']])


                <div class="clearfix"></div>
                @include('form.checkbox',['var'=>['name'=>'is_visible','label'=>'Visible','div'=>'col-md-3 bordered-checkbox']])
                @include('form.is-active')
                {{--    Form inputs: ends    --}}

                @include('form.action-buttons')
            </div>
            {{ Form::close() }}

        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.module-groups.form.js')
@endsection

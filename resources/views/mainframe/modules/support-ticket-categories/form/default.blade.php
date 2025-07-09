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
 * @var \App\SupportTicketCategory $element
 * @var \App\SupportTicketCategory $supportTicketCategory
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\SupportTicketCategories\SupportTicketCategoryViewProcessor $view
 */
$supportTicketCategory = $element;
?>

@section('content')
    <div class="row">
        <div class="col-md-11 col-lg-9 col-xl-8">
            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            @include('form.text',['var'=>['name'=>'name','label'=>'Name','div'=>'col-md-4']])
            @include('form.select-model',['var'=>['name'=>'parent_id','label'=>'Parent Category', 'model'=>\App\SupportTicketCategory::class, 'name_field'=>'name_ext','class'=>'select2','div'=>'col-md-4']])
            @include('form.text',['var'=>['name'=>'order','label'=>'Order/Serial','div'=>'col-md-2']])
            @include('form.tags',['var'=>['name'=>'email_recipients','label'=>'Email Recipients','div'=>'col-md-6']])

            {{-- <div class="form-group col-md-6">--}}
            {{--     <label>Upload {{\App\Upload::TYPE_GENERIC}}</label><small>Upload one or more files</small>--}}
            {{--     @include('form.uploads',['var'=>['limit'=>10,'type'=>\App\Upload::TYPE_GENERIC]])--}}
            {{-- </div>--}}

            <div class="clearfix"></div>
            @include('form.is-active')
            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.support-ticket-categories.form.js')
@endsection

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
 * @var \App\SupportTicketTag $element
 * @var \App\SupportTicketTag $supportTicketTag
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\SupportTicketTags\SupportTicketTagViewProcessor $view
 */
$supportTicketTag = $element;
?>

@section('content')
    <div class="row">
        <div class="col-md-11 col-lg-9 col-xl-8">
            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            @include('form.text',['var'=>['name'=>'name','label'=>'Name','div'=>'col-md-6']])
            <div class="clearfix"></div>
            @include('form.textarea',['var'=>['name'=>'description','label'=>'Description']])

            <div class="clearfix"></div>
            @include('form.is-active')
            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.support-ticket-tags.form.js')
@endsection

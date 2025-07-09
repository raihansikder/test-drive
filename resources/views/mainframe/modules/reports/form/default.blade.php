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
 * @var \App\Report $element
 * @var \App\Report $report
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\Reports\ReportViewProcessor $view
 */
$report = $element;
?>

@section('content-top')
    @parent
    @if($element->isCreated())
        <a href="{!! $element->url() !!}" class="btn btn-default bg-smart-blue" target="_blank">Run Report</a>
    @endif
    <div class="clearfix margin"></div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">

            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            {{--    Form inputs: starts    --}}
            {{--   --------------------    --}}
            @include('form.text',['var'=>['name'=>'name','label'=>'Name']])
            @include('form.text',['var'=>['name'=>'code','label'=>'Code']])
            {{-- @include('form.text',['var'=>['name'=>'title','label'=>'Title']])--}}
            @include('form.textarea',['var'=>['name'=>'description','label'=>'Description']])
            @include('form.textarea',['var'=>['name'=>'parameters','label'=>'Parameters']])
            @include('form.text',['var'=>['name'=>'type','label'=>'type']])
            @include('form.text',['var'=>['name'=>'version','label'=>'Version']])
            @include('form.text',['var'=>['name'=>'module_id','label'=>'Module ID']])
            {{-- is_module_default--}}
            @include('form.tags',['var'=>['name'=>'tags','label'=>'Tags','tags'=>\App\Spread::tags()]])
                <div class="clearfix"></div>
            @include('form.is-active')
            {{-- Form inputs: ends    --}}
            @include('form.action-buttons')

            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.reports.form.js')
@endsection

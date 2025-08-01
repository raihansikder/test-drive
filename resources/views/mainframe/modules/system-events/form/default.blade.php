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
 * @var \App\SystemEvent $element
 * @var \App\SystemEvent $systemEvent
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\SystemEvents\SystemEventViewProcessor $view
 */
$systemEvent = $element;
$tags = ($element->tags) ? implode(',', $element->tags) : null;
?>

@section('content')
    <div class="row">
        <div class="col-md-11 col-lg-9 col-xl-8">
            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            @include('form.text',['var'=>['name'=>'name','label'=>'Name']])

            @include('form.text',['var'=>['name'=>'provider','label'=>'Provider','div'=>'col-md-4']])
            <div class="clearfix"></div>
            @include('form.select-array',['var'=>['name'=>'source','label'=>'Source','options'=>kv(\App\SystemEvent::$sources)]])
            @include('form.select-array',['var'=>['name'=>'environment','label'=>'Environment','options'=>kv(\App\SystemEvent::$envs)]])
            @include('form.select-array',['var'=>['name'=>'type','label'=>'Type','options'=>kv(\App\SystemEvent::$types)]])

            @include('form.datetime',['var'=>['name'=>'occurred_at','label'=>'Occurred At']])
            <div class="clearfix"></div>
            @include('form.select-model',['var'=>['name'=>'module_id','label'=>'Module','model'=>App\Module::class,'class'=>'select2','name_field'=>'title','show_inactive'=>true]])
            @include('form.text',['var'=>['name'=>'element_id','label'=>'Element Id']])
            @include('form.text',['var'=>['name'=>'element_uuid','label'=>'Element UUID','div'=>'col-md-4']])

            <div class="clearfix"></div>
            @include('form.select-ajax',['var'=>['name'=>'user_id','label'=>'User','model'=>App\User::class,'class'=>'select2']])
            @include('form.tags',['var'=>['name'=>'tags','label'=>'Tags','div'=>'col-md-6','tags'=>\App\Spread::tags(), 'value'=>$tags]])
            @include('form.text',['var'=>['name'=>'url','label'=>'URL','div'=>'col-md-4']])
            @include('form.text',['var'=>['name'=>'ip_address','label'=>'IP Address']])
            @include('form.text',['var'=>['name'=>'user_agent','label'=>'User Agent','div'=>'col-md-12']])
            {{--@include('form.textarea',['var'=>['name'=>'details','label'=>'Details']])--}}
            <div class="clearfix"></div>
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a data-toggle="collapse" href="#details_panel">
                                <i class="fa fa-info-circle"></i>Details
                            </a>
                        </h5>
                    </div>
                    <div id="details_panel" class="panel-collapse collapse" style="margin:15px 0;">
                        <div class="col-md-12">
                            @dump($element->details)
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            @include('form.is-active')
            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.system-events.form.js')
@endsection

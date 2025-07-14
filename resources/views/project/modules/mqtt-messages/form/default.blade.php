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
 * @var \App\MqttMessage $element
 * @var \App\MqttMessage $mqttMessage
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\MqttMessages\MqttMessageViewProcessor $view
 */
$mqttMessage = $element;
?>



@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">
            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            {{-- Form inputs - start >>> ---------------------------------------------------------------}}
            @include('form.text',['var'=>['name'=>'topic','label'=>'MQTT Topic','div'=>'col-md-6']])
            {{-- @include('form.text',['var'=>['name'=>'name','label'=>'Name','div'=>'col-md-3']])--}}

            {{-- todo uncomment once the device module is ready --}}


            @include('form.select-ajax',['var'=>['name'=>'client_id','label'=>'Client','model'=>\App\Client::class]])
            @include('form.select-ajax',['var'=>['name'=>'user_id','label'=>'User','model'=>\App\User::class]])
            {{-- @include('form.select-ajax',['var'=>['name'=>'device_id','label'=>'Device','model'=>\App\Device::class]])--}}
            @include('form.text',['var'=>['name'=>'device_uid','label'=>'Device Uid','div'=>'col-md-6']])

            <h3>Message</h3>
            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'type','label'=>'Message Type','div'=>'col-md-6']])
            @include('form.select-array',['var'=>['name'=>'is_processable','label'=>'Processable?','options'=>[0=>'No',1=>'Yes']]])
            @include('form.select-array',['var'=>['name'=>'is_processed','label'=>'Processed?','options'=>[0=>'No',1=>'Yes']]])

            @include('form.textarea',['var'=>['name'=>'body','label'=>'Body(raw)','div'=>'col-md-12', 'class'=>'height-auto']])
            <div class="clearfix"></div>
            <div class="col-md-12 form-group">
                <label class="form-group">JSON Payload(Body)</label>
                @dump($element->body_json)
            </div>
            @include('form.textarea',['var'=>['name'=>'processing_note','label'=>'Processing Note','div'=>'col-md-12']])
            {{-- @include('form.is-active')--}}
            {{-- <<< Form inputs - ends  ---------------------------------------------------------------}}

            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('content-bottom')
    @parent
    @if($element->isCreated())
        {{--<div class="row">--}}
        {{--    <div class="col-md-10 col-lg-9 col-xl-8">--}}
        {{--        <div class="col-md-6 form-group">--}}
        {{--            <label>Upload {{\App\Upload::TYPE_GENERIC}}</label> <small>Upload one or more files</small>--}}
        {{--            @include('form.uploads',['var'=>['type'=>\App\Upload::TYPE_GENERIC,'limit'=>10, 'bucket'=>'mqtt-messages']])--}}
        {{--        </div>--}}
        {{--    </div>--}}
        {{--</div>--}}
    @endif
@endsection

@section('js')
    @parent
    @include('project.modules.mqtt-messages.form.js')
@endsection

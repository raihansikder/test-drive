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
 * @var \App\PushNotification $element
 * @var \App\PushNotification $pushNotification
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\PushNotifications\PushNotificationViewProcessor $view
 */
$pushNotification = $element;
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
            @include('form.select-model',['var'=>['name'=>'user_id','label'=>'User','table'=>'users','class'=>'col-md-4']])
            @include('form.text',['var'=>['name'=>'device_token','label'=>'Device Token (FCM Token)']])

            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'name','label'=>'Name(Message Title)']])
            <div class="clearfix"></div>
            @include('form.textarea',['var'=>['name'=>'body','label'=>'Body','div'=>'col-md-6']])
            <div class="clearfix"></div>
            @include('form.textarea',['var'=>['name'=>'data','label'=>'Data']])
            <div class="clearfix"></div>
            {{--@include('form.text',['var'=>['name'=>'in_app_notification_id','label'=>'In-App Notification Id']])--}}

            @include('form.text',['var'=>['name'=>'order','label'=>'Order']])
            @include('form.text',['var'=>['name'=>'type','label'=>'Type']])
            @include('form.text',['var'=>['name'=>'event','label'=>'Event']])

            <div class="clearfix"></div>
            <div class="col-md-6 no-padding-l">
                <code>API Response</code>
                @dump($element->api_response_json)

            </div>

            <div class="col-md-6 no-padding-l">
                <h3>Object</h3>
                @dump(json_decode($element->toJson()))
            </div>
            {{---------------|  Form input start |-----------------------}}

            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.push-notifications.form.js')
@endsection

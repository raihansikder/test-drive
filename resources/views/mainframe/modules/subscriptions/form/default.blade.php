@extends('project.layouts.module.form.template')
<?php

use App\Module;
use App\Project\Modules\Subscriptions\SubscriptionViewProcessor;
use App\Subscription;
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
 * @var Subscription $element
 * @var Subscription $subscription
 * @var Tenant $tenant
 * @var SubscriptionViewProcessor $view
 */
$subscription = $element;
?>

@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">
            @if($formState === 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState === 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            {{---------------|  Form input start |-----------------------}}
            @include('form.text',['var'=>['name'=>'name','label'=>'Name']])

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
    @include('mainframe.modules.subscriptions.form.js')
@endsection

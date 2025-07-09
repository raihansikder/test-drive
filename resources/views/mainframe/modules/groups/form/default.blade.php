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
 * @var \App\Group $element
 * @var \App\Group $group
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\Groups\GroupViewProcessor $view
 */
$group = $element;
?>

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
            @include('form.text',['var'=>['name'=>'title','label'=>'Title']])
            @include('form.text',['var'=>['name'=>'name','label'=>'System Name']])
            <div class="clearfix"></div>
            @include('form.is-active')
            {{--    Form inputs: ends    --}}
            <div class="clearfix"></div>
            @if($formState === 'edit')
                @include('mainframe.modules.groups.form.permission-blocks')
            @endif

            <div class="clearfix"></div>
            @include('form.action-buttons')

            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.groups.form.js')
@endsection

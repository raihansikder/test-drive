@extends('project.layouts.default.template')
<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var \App\User $element
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 */

// dd(get_class($view));
?>

@section('title')
    @include('mainframe.layouts.module.form.includes.title-with-name')
@endsection

@section('content')
    <div class="col-md-12 no-padding">
        @if(($formState === 'create'))
            {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$element->uuid}}"/>
        @elseif($formState === 'edit')
            {{ Form::model($element, $formConfig)}}
        @endif

        @yield('form-fields')

        @include('mainframe.form.action-buttons')

        {{ Form::close() }}
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.layouts.module.form.includes.js')
@endsection

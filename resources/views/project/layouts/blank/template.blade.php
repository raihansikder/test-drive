<!DOCTYPE html>
<?php
/**
 * @var \App\Mainframe\Features\Core\ViewProcessor $view
 */
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @section('head-title')
            {{config('app.name')}}
            {{isset($module) ? ' | '. $module->title: ''}} {{isset($element) ? $element->id."-".$element->name : ''}}
        @show
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @section('head')
    @show
    @include('mainframe.layouts.default.includes.css')
</head>
<body class="hold-transition skin-blue-light sidebar-mini fixed">

<div id="root" class="wrapper">

    @section('modal-content')
    @show

</div>

@include('mainframe.layouts.default.includes.js')
@section('js')
    {{-- section: js--}}
@show
</body>
</html>

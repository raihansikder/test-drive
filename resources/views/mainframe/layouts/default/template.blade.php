<!DOCTYPE html>
<?php
/**
 * @var \App\Mainframe\Features\Core\ViewProcessor $view
 * @var \App\Module $module
 */

?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        {{-- Section: head-title--}}
        @section('head-title')
            {{config('app.name')}}
            {{isset($module) ? ' | '. $module->title: ''}} {{isset($element) ? $element->id."-".$element->name : ''}}
        @show
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('mainframe.layouts.default.includes.css')

    {{-- Section: head--}}
    @section('head')
    @show

</head>
<body class="hold-transition skin-blue-light sidebar-mini fixed">

<div id="root" class="wrapper">
    <header class="main-header">
        @include('mainframe.layouts.default.includes.main-header')
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            {{-- Section: sidebar-left--}}
            @section('sidebar-left')
                @include('mainframe.layouts.default.includes.navigation.left-menu.menu-items')
            @show
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h2>
                {{-- Section: title--}}
                @section('title')
                @show
            </h2>
            {{-- Section: breadcrumb--}}
            @section('breadcrumb')
            @show
        </section>

        <!-- Main content -->
        <section class="content col-md-12">
            @include('mainframe.layouts.default.includes.alerts.messages-top')

            {{-- Section: content-top--}}
            @section('content-top')
            @show
            <div class="clearfix"></div>

            {{-- Section: content--}}
            @section('content')
            @show
            <div class="clearfix"></div>

            {{-- Section: content-bottom--}}
            @section('content-bottom')
            @show
        </section>
    </div>
    @include('mainframe.layouts.default.includes.modals.dynamic-modal')
    @include('mainframe.layouts.default.includes.modals.messages')
    @include('mainframe.layouts.default.includes.modals.delete')
    @include('mainframe.layouts.default.includes.modals.confirm')
</div>

@include('mainframe.layouts.default.includes.js')

{{-- Section: head--}}
@section('js')
@show

</body>
</html>

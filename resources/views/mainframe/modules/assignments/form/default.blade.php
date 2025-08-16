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
 * @var \App\Assignment $element
 * @var \App\Assignment $assignment
 * @var \App\Tenant $tenant
 * @var \App\Project\Modules\Assignments\AssignmentViewProcessor $view
 */
$assignment = $element;
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
            @include('form.select-ajax',['var'=>['name'=>'assignee_user_id','label'=>'Assignee','model'=>App\User::class,'class'=>'select2']])
            <div class="clearfix"></div>
            @include('form.textarea',['var'=>['name'=>'note','label'=>'Note','div'=>'col-md-9']])
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-9">
                    <?php
                    $section = 'linked-module'
                    ?>
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <a data-toggle="collapse" href="#{{$section}}_panel">
                                        <i class="fi fi-rr-link-horizontal"></i>
                                        Linked Module
                                    </a>
                                </h5>
                            </div>
                            <div id="{{$section}}_panel" class="panel-collapse collapse" style="margin:15px 0;">
                                <div class="col-md-12">
                                    @include('form.select-model',['var'=>['name'=>'module_id','label'=>'Module','model'=>App\Module::class,'class'=>'select2','show_inactive'=>true]])
                                    @include('form.text',['var'=>['name'=>'element_id','label'=>'Element Id']])
                                    <div class="clearfix"></div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
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
    @include('mainframe.modules.assignments.form.js')
@endsection

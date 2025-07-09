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
 * @var \App\Setting $element
 * @var \App\Setting $setting
 * @var \App\Project\Modules\Settings\SettingViewProcessor $view
 */
$setting = $element;
?>

@section('content-top')
    @parent
    @include('mainframe.form.download-all-btn')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">

            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            {{-- Section: Form inputs: starts --}}
            @include('form.text',['var'=>['name'=>'name','label'=>'Name']])
            @include('form.text',['var'=>['name'=>'title','label'=>'Title']])
            @include('form.select-array',['var'=>['name'=>'type','label'=>'type','options'=>\App\Setting::$types]])
            @include('form.textarea',['var'=>['name'=>'value','label'=>'Value(For array type put JSON)','div'=>'col-md-12']])
            @include('form.textarea',['var'=>['name'=>'description','label'=>'Description','div'=>'col-md-12', 'params'=>['id'=>'description']]])
                <div class="clearfix"></div>
            @include('form.is-active')
            {{-- Section: Form inputs: ends --}}

            @include('form.action-buttons',['float'=>false])
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('content-bottom')
    @parent
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">

            {{-- File upload --}}
            <div class="col-md-6 form-group">
                {{-- <h3>File upload</h3>--}}
                {{-- <label>Upload one or more files</label>--}}
                {{-- @include('form.uploads',['var'=>['limit'=>99, 'bucket'=>'public','uploader_function'=>'initSingleFileUploader']])--}}

                <h3>File upload</h3>
                <label>Upload one or more files</label>
                <?php
                $var = [
                    'type' => \App\Upload::TYPE_SETTING_PUBLIC,
                    'limit' => 99,
                    'bucket' => 'public/'.$module->name,
                    'uploader_function' => 'initSingleFileUploader',
                ];
                ?>
                @include('form.uploads',['var'=>$var])
                <div class="clearfix"></div>

                <h3>File upload</h3>
                <?php
                $var = [
                    'limit' => 99, 'bucket' => $module->name,
                    'uploader_function' => 'initSingleFileUploader',
                    'type' => \App\Upload::TYPE_GENERIC,
                    'card_css' => 'col-md-6'
                ];
                ?>
                @include('form.uploads',['var'=>$var])
            </div>

            {{-- Comment --}}
            <div class="col-md-6 form-group">
                @if($view->showCommentSection())
                    <div class="col-md-12 bordered">
                        <h3 class="pull-left">Comments</h3>
                        @include('form.comments')
                    </div>
                @endif
                @if($element->isCreated())
                    <div class="col-md-12 bordered m-t-20">
                        <h3>Assignments</h3>
                        @include('form.assignments')
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent
    @include('mainframe.modules.settings.form.js')
    <script>
        autosize(document.querySelectorAll('textarea'));

        // CKEditor with autogrow
        initEditor('description', _.merge(editor_config_extended, {
                extraPlugins: 'autogrow',
                autoGrow_onStartup: true,
                // autoGrow_maxHeight: 400,
                removePlugins: 'resize'
            })
        );
    </script>
@endsection

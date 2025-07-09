@extends('project.layouts.module.form.template')

<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var \App\Upload $element
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $uploadable
 * @var \App\Project\Modules\Uploads\UploadViewProcessor $view
 */
?>

@section('content-top')
    @parent
    @include('mainframe.form.back-link',['var'=>['element'=>$element->uploadable]])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">
            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            @include('form.text',['var'=>['name'=>'name','label'=>'Name','div'=>'col-md-6']])
            @include('form.text',['var'=>['name'=>'type','label'=>'Type']])
            <div class="clearfix"></div>

            @include('form.text',['var'=>['name'=>'ext','label'=>'Extension', 'div'=>'col-md-2']])
            @include('form.number',['var'=>['name'=>'order','label'=>'Order','div'=>'col-md-2']])
            @include('form.text',['var'=>['name'=>'bytes','label'=>'Bytes','div'=>'col-md-2']])
            <div class="clearfix"></div>

            @include('form.textarea',['var'=>['name'=>'description','label'=>'Description','div'=>'col-md-6']])

            @if($element->isCreated())
                <div class="clearfix"></div>
                <?php
                $value = 'URL: ';
                if ($element->isPublic()) {
                    $value = "<span class='badge badge-danger'>PUBLIC</span> ".$element->url;
                } else {
                    $value = $element->downloadUrl();
                }
                ?>
                <div class="form-group col-md-12">
                    <label class="control-label">URL</label>
                    <span class="form-control readonly">{!! $value !!}</span>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">Storage</label>
                    <span class="form-control readonly">{!! $element->absPath() !!}</span>
                </div>
            @endif

            <div class="clearfix"></div>
            @if($element->isCreated())
                <div class="clearfix"></div>
                <div class="col-md-6 no-padding-l">
                    <small>Update existing file</small>
                    @include('mainframe.layouts.module.form.includes.features.uploads.update-uploaded-file')
                </div>
            @endif

            <div class="clearfix"></div>
            @include('form.is-active')
            @include('form.action-buttons',['float'=>false])

            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.uploads.form.js')
    @if($element->uploadable)
        <script>
            $('.delete-btn').attr('data-redirect_success', '{!! $element->uploadable->editUrl() !!}')
        </script>
    @endif
@endsection

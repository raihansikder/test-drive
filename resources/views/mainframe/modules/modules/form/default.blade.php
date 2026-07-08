@extends('project.layouts.module.form.template')

@section('content')
    <div class="col-md-12 col-lg-10 no-padding">


        @if($formState === 'create')
            {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
        @elseif($formState === 'edit')
            {{ Form::model($element, $formConfig)}}
        @endif
        <div class="row">
            <div class="col-md-10 col-lg-9 col-xl-8">

                {{--    Form inputs: starts    --}}
                {{--   --------------------    --}}
                @include('form.text',['var'=>['name'=>'name','label'=>'Name (kebab-case)','div'=>'col-md-6']])
                @include('form.text',['var'=>['name'=>'title','label'=>'Title','div'=>'col-md-6']])

                {{-- @include('form.select.select-model',['var'=>['name'=>'parent_id','label'=>'Parent module', 'table'=>'modules']])--}}
                @include('form.select-ajax',['var'=>['label' => 'Parent', 'name' => 'parent_id', 'model' => \App\Module::class,'div'=>'col-md-6']])
                @include('form.select-model',['var'=>['name'=>'module_group_id','label'=>'Module group', 'model'=>\App\ModuleGroup::class, 'name_field'=>'title','div'=>'col-md-6']])
                @include('form.text',['var'=>['name'=>'level','label'=>'Level','div'=>'col-md-6']])
                @include('form.text',['var'=>['name'=>'order','label'=>'Order','div'=>'col-md-6']])
                @include('form.text',['var'=>['name'=>'color_css','label'=>'Color CSS class','div'=>'col-md-6']])
                @include('form.text',['var'=>['name'=>'icon_css','label'=>'Icon CSS class','div'=>'col-md-6']])
                @include('form.text',['var'=>['name'=>'default_route','label'=>'Default route name','editable'=>false,'div'=>'col-md-12']])

                <div class="clearfix"></div>
                @include('form.textarea',['var'=>['name'=>'description','params'=>['class'=>'ckeditor'],'label'=>'Description', 'div'=>'col-sm-12']])
                <div class="clearfix"></div>

                @include('form.is-active')
                {{--    Form inputs: ends    --}}

                @include('form.action-buttons')
            </div>
        </div>
        {{ Form::close() }}

    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.modules.form.js')
@endsection

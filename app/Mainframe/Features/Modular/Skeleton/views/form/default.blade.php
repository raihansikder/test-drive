@extends('{project-name}.layouts.module.form.template')
<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var array $immutables
 * @var \App\SuperHero $element
 * @var \App\SuperHero $superHero
 * @var \App\Tenant $tenant
 * @var \App\Mainframe\Modules\SuperHeroes\SuperHeroViewProcessor $view
 */
$superHero = $element;
?>

@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-9 col-xl-8">
            @if($formState == 'create')
                {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
            @elseif($formState == 'edit')
                {{ Form::model($element, $formConfig)}}
            @endif

            {{-- Form inputs - start >>> ---------------------------------------------------------------}}
            @include('form.text',['var'=>['name'=>'name','label'=>'Name']])
            <div class="clearfix"></div>
            @include('form.is-active')
            {{-- <<< Form inputs - ends  ---------------------------------------------------------------}}

            @include('form.action-buttons')
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('content-bottom')
    @parent
    @if($element->isCreated())
        {{--<div class="row">--}}
        {{--    <div class="col-md-10 col-lg-9 col-xl-8">--}}
        {{--        <div class="col-md-6 form-group">--}}
        {{--            <label>Upload {{\App\Upload::TYPE_GENERIC}}</label> <small>Upload one or more files</small>--}}
        {{--            @include('form.uploads',['var'=>['type'=>\App\Upload::TYPE_GENERIC,'limit'=>10, 'bucket'=>'super-heroes']])--}}
        {{--        </div>--}}
        {{--    </div>--}}
        {{--</div>--}}
    @endif
@endsection

@section('js')
    @parent
    @include('mainframe.modules.super-heroes.form.js')
@endsection

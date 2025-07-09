@extends('project.layouts.module.form.template')

<?php
/**
 * @var \App\User $element
 * @var string $formState create|edit
 * @var string $formState
 * @var array $formConfig
 * @var string $uuid Only available during creation
 * @var bool $editable
 * @var \App\Module $module
 * @var \App\Project\Modules\Users\UserViewProcessor $view
 */
?>

@section('content')
    <div class="col-md-12 col-lg-10 no-padding">
        {{--@dd($formConfig)--}}
        @if($formState == 'create')
            {{ html()->modelForm($element,'POST',$element->storeUrl())->attributes($formConfig)->acceptsFiles()->open() }}
            <input name="uuid" type="hidden" value="{{$uuid}}"/>
        @elseif($formState == 'edit')
            {{ html()->modelForm($element,'PATCH',$element->updateUrl())->attributes(array_except($formConfig,'route'))->acceptsFiles()->open() }}
        @endif

        @include('form.text',['var'=>['name'=>'first_name','label'=>'First Name', 'tooltip'=>'First Name']])
        @include('form.text',['var'=>['name'=>'last_name','label'=>'Last Name']])
        @include('form.text',['var'=>['name'=>'email','label'=>'Email']])
        @include('form.text',['var'=>['name'=>'week','label'=>'Week', 'type'=>'week']])
        @include('form.datetime',['var'=>['name'=>'email_verified_at','label'=>'Email verified at']])

        {{-- show password only for editable--}}
        @if($editable)
            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'password','type'=>'password','label'=>'New password','value'=>'']])
            @include('form.text',['var'=>['name'=>'password_confirmation','type'=>'password','label'=>'Confirm new password']])
        @endif

        <div class="clearfix"></div>
        <h3>Group Selection</h3>
        <?php
        $var = [
            'name' => 'group_ids',
            // 'label' => 'Group',
            'model' => new \App\Group,
            'name_field' => 'title',
            'params' => ['id' => 'groups'],
            'div' => 'col-sm-12',
            'data_attributes' => ['name']
        ];
        ?>
        @include('form.select-model-multiple', compact('var'))
        <div class="clearfix"></div>

        {{-- Section: Show input fields for specific user group--}}
        <div class="conditionally-visible depends-on-groups groups-{{\App\User::USER_GROUP}}">
            Show fields for {{\App\User::USER_GROUP}}
        </div>
        <div class="conditionally-visible depends-on-groups groups-{{\App\User::TENANT_ADMIN_GROUP}}">
            Show fields for {{\App\User::TENANT_ADMIN_GROUP}}
        </div>

        <div class='clearfix'></div>
        @include('mainframe.modules.users.form.includes.token-fields')
        <div class="clearfix"></div>
        {{--@include('form.is-active')--}}
        @include('form.action-buttons')

        {{ html()->form()->close() }}
    </div>
@endsection

@section('content-bottom')
    @parent
    <div class="row">
        <div class="col-md-3">
            <h3>Upload profile pic</h3>
            <small>Upload one or more files</small>
            @include('form.uploads',['var'=>['type'=>\App\Upload::TYPE_PROFILE_PIC,'bucket'=>'public/'.$module->name,'limit'=>1]])
        </div>
    </div>
@endsection

@section('js')
    @parent
    @include('project.modules.users.form.js')
    <script>
        /*
        |--------------------------------------------------------------------------
        | Show a div block based on some selection
        |--------------------------------------------------------------------------
        */
        showDivsBasedOnSelect('groups', 'data-name');

        // $('#groups').on('change', function () {
        //     var identifiers = getMultiSelectAsArray('#groups', 'data-name');
        //     $('.depends-on-groups').hide(); // Hide all dependant group
        //     _(identifiers).forEach(function (identifier) { // This is a low-dash function :)  https://lodash.com/docs/2.4.2#forEach
        //         if (identifier.length) {
        //             $('div.' + identifier).show();
        //         }
        //     })
        // }).trigger('change');
    </script>
@endsection

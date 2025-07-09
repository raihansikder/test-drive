@extends('project.layouts.centered.template')
<?php
/** @var \App\Mainframe\Modules\Groups\Group $group */
?>

@section('content')

    <h4>{{ $group->title }} Registration </h4>

    <div class="card-body" style="padding-left: 10px">

        {{ Form::open(['route' => ['register',$group->name],'class'=>"user-registration-form", 'name'=>'user_registration_form']) }}

        <input type="hidden" name="redirect_success" value="{!! route('login',['verify_email'=>1]) !!}">
        <input type="hidden" name="ret" value="">

        {{-- <input type="hidden" name="group_ids[]" value="{{$group->id}}"> --}}
        @include('form.text',['var'=>['name'=>'first_name','label'=>'First Name', 'div'=>'col-sm-12']])
        @include('form.text',['var'=>['name'=>'last_name','label'=>'Last Name', 'div'=>'col-sm-12']])
        @include('form.text',['var'=>['name'=>'mobile','label'=>'Contact No.', 'div'=>'col-sm-12']])
        @include('form.text',['var'=>['name'=>'email','label'=>'Email', 'div'=>'col-sm-12']])
        @include('form.text',['var'=>['name'=>'password','type'=>'password','label'=>'Password','value'=>'', 'div'=>'col-sm-12']])
        @include('form.text',['var'=>['name'=>'password_confirmation','type'=>'password','label'=>'Confirm Password', 'div'=>'col-sm-12']])

        <div class="col-md-12 no-padding-l margin-v-15">
            <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('Register') }}</button>
        </div>

        {{ Form::close() }}

        <div class="col-md-12 text-center">
            <a class="btn btn-light" href="{{route('login')}}"> Already Registered? Go to Login</a>&nbsp;&nbsp;|
            <a href="{{ route('home') }}">{{ __('Home') }}</a>
        </div>

        <div class="clearfix"></div>
    </div>

@endsection

@section('js')
    @parent
    <script>
        function addValidationRules() {
            $("input[name=email]").addClass('validate[required]');
            $("input[name=password]").addClass('validate[required]');
        }

        // addValidationRules();
        enableAjaxFormSubmission('user_registration_form',
            function (response) {
                $('.modal').modal('hide');       // 1. Hide all open modals
                showResponseModal(response);     // 2. Show response/status in the message modal

                if (v.count(response.redirect)) {  // 3. Redirect if a redirect_success URL exits
                    setTimeout(() => {
                        window.location.replace(response.redirect);
                    }, 10000);
                }
            }); // Enable Ajax based form validation.
    </script>
@endsection

@extends('project.layouts.centered.template')

<?php
/*
|--------------------------------------------------------------------------
| Show the new password entry form
|--------------------------------------------------------------------------
| Show user email, password, password_confirm input to reset the password
|
*/
?>

@section('content')

    <h4>Password reset</h4>

    <div class="card-body">

        {{--        @if (session('status'))--}}
        {{--            <div class="alert alert-success" role="alert">--}}
        {{--                A password link has been sent to your email address.--}}
        {{--            </div>--}}
        {{--        @endif--}}

        <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            @include('mainframe.form.text',['var'=>['name'=>'email','label'=>'Email','div'=>'col-sm-12', 'editable'=>false]])
            @include('mainframe.form.text',['var'=>['name'=>'password','type'=>'password','label'=>'New password','value'=>'','div'=>'col-sm-12']])
            @include('mainframe.form.text',['var'=>['name'=>'password_confirmation','type'=>'password','label'=>'Confirm new password','div'=>'col-sm-12']])

            <input class="btn btn-primary btn-block" type="submit" value="Reset Password">
        </form>
    </div>

@endsection

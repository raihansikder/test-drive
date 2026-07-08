@extends('project.layouts.centered.template')

<?php
/**
 * @var Illuminate\Support\ViewErrorBag $errors
 */

?>

@section('content')
    <div class="card-body">
        
        <div class="row">
            <div class="col-md-12">
                {{-- Ask for email verification. This is used for post registration redirect to login page--}}
                @include('mainframe.auth.includes.email-verification-messages')
                
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <input name="loginRedirect" type="hidden" value="{{Request::get('loginRedirect')}}"/>
                    
                    {{-- login --}}
                    @include('form.text',['var'=>['name'=>'email', 'div'=>'col-md-12 npr','params'=>['placeholder'=>'Username']]])
                    @include('form.text',['var'=>['name'=>'password','type'=>'password', 'value'=>'','div'=>'col-md-12 npr','params'=>['placeholder'=>'Password']]])
                    @include('form.checkbox',['var'=>['name'=>'remember','label'=>__('Remember Me'),'div'=>'col-md-12']])
                    
                    <button type="submit" class="btn btn-primary btn-block btn-login">
                        {{ __('Login') }}
                    </button>
                    
                    {{-- Reset password --}}
                    <div class="col-md-12 text-center margin-v-15">
                        <a href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                    </div>
                    <div class="clearfix"></div>
                    {{-- Register --}}
                    <div class="col-md-12 text-center">
                        <a target="_blank"
                           href="{{route('register.tenant')}}">{{ __('Register your account') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

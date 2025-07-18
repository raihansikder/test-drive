@extends('project.layouts.centered.template')

<?php
/*
|--------------------------------------------------------------------------
| Show password protected
|--------------------------------------------------------------------------
| Occasionally a user will be asked to re-enter password to access a page
| or route protect by 'password.confirm' middleware. In those cases
| the following form will be shown
*/
?>

@section('content')

    <h4>{{ __('Confirm Password') }}</h4>

    <div class="card-body">

        {{ __('Please confirm your password before continuing.') }}

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            @include('mainframe.form.text',['var'=>['name'=>'password','type'=>'password','label'=>'Password','value'=>'','div'=>'col-sm-12']])

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Confirm Password') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>

        </form>

    </div>

@endsection

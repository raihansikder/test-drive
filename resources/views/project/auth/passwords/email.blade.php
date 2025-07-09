@extends('project.layouts.centered.template')

<?php
/*
|--------------------------------------------------------------------------
| Show the reset password request form to input email
|--------------------------------------------------------------------------
| The email captured in the form is used to send a reset password link.
|
*/
?>

@section('content')

    <h4>Password Reset</h4>

    <div class="card-body">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                A password link has been sent to your email address.
            </div>

            <a href="{{route('login')}}">Go to login</a>
        @else
            <form name="reset_password_form" method="POST" action="{{ route('password.email') }}"
                  aria-label="{{ __('Reset Password') }}">
                @csrf

                @include('mainframe.form.text',['var'=>['name'=>'email','label'=>'Email', 'div'=>'col-sm-12 no-padding-r']])

                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>

@endsection

@section('js')
    @parent
    <script>

        $("input[name=email]").addClass('validate[required]');

        addRequiredIconsToLabels();

        $('form[name=reset_password_form]').validationEngine({
            prettySelect: true,
            promptPosition: "topLeft",
            scroll: true
        });
    </script>

@endsection

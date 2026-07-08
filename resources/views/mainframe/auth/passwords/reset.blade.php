@extends('mainframe.layouts.centered.template')

@section('content')
    
    <h4>Password reset</h4>
    
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                A password link has been sent to your email address.
            </div>
            
            <a href="{{route('login')}}">Go to login</a>
        @else
            <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="row">
                    <div class="col-md-12">
                        @include('form.text',['var'=>['name'=>'email','label'=>'Email','div'=>'col-md-12 npr', 'editable'=>false]])
                        @include('form.text',['var'=>['name'=>'password','type'=>'password','label'=>'New password','value'=>'','div'=>'col-md-12 npr']])
                        @include('form.text',['var'=>['name'=>'password_confirmation','type'=>'password','label'=>'Confirm new password','div'=>'col-md-12 npr']])
                    </div>
                </div>
                <input class="btn btn-primary btn-block" type="submit" value="Reset Password">
            </form>
        @endif
    </div>

@endsection

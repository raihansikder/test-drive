{{-- This message shown when the user is redirect to login page after registration --}}
@if (request('verify_email')==1)
    <div class="alert alert-success" role="alert">
        A verification link has been sent to your email address. Click the link and login with your username and
        password to complete the verification.
    </div>
@endif

{{-- This message is shown when user clicks on email verification link and it takes user to login page to complete the final verification step --}}
@if (\Str::contains(session()->get('url.intended'),'verify'))
    <div class="alert alert-success" role="alert">
        Please login to complete your email verification.
    </div>
@endif

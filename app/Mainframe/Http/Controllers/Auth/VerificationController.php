<?php

namespace App\Mainframe\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Project\Http\Controllers\BaseController;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends BaseController
{
    /*
     |--------------------------------------------------------------------------
     | Email Verification Controller
     |--------------------------------------------------------------------------
     |
     | This controller is responsible for handling email verification for any
     | user that recently registered with the application. Emails may also
     | be re-sent if the user didn't receive the original email message.
     |
     */
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/'; // Default redirect to home '/'
    /** @var string */
    protected $view = 'mainframe.auth.verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  Request  $request
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(Request $request)
    {
        if ($request->user()) {
            return $request->user()->hasVerifiedEmail()
                ? redirect($this->redirectPath())
                : view('mainframe.auth.verify');
        }

        return view('mainframe.auth.verify');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  Request  $request
     * @return JsonResponse|RedirectResponse
     * @throws AuthorizationException
     */
    public function verify(Request $request)
    {
        if (!hash_equals((string) $request->route('id'), (string) $request->user()->getKey())) {
            throw new AuthorizationException;
        }

        if (!hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($response = $this->verified($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectPath())->with('verified', true);
    }

    /**
     * The user has been verified.
     *
     * @param  Request  $request
     * @return Factory|JsonResponse|RedirectResponse|View|void
     */
    protected function verified(Request $request)
    {
        return $this->success("Your email has been verified successfully")
            ->setRedirectTo($this->redirectPath())
            ->send();
    }

}

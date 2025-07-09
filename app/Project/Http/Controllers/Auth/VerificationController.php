<?php

namespace App\Project\Http\Controllers\Auth;

use View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Project\Features\Core\ViewProcessor;
use App\Mainframe\Http\Controllers\Auth\VerificationController as MfVerificationController;

class VerificationController extends MfVerificationController
{
    public function __construct()
    {
        parent::__construct();
        // Share project's view processor
        $this->view = new ViewProcessor();
        View::share([
            'view' => $this->view,
        ]);
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        if ($request->user()) {
            return $request->user()->hasVerifiedEmail()
                ? redirect($this->redirectPath())
                : view('project.auth.verify');
        }

        return view('project.auth.verify');
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson()
            ? new JsonResponse([], 202)
            : redirect('email/verify')->with('resent', true); // Instead of back() using redirect
    }

}

<?php

namespace App\Mainframe\Modules\Emails\Traits;

use App\Email;

/** @mixin \App\Mainframe\Modules\Emails\EmailController */
trait EmailControllerTrait
{
    /*
    |--------------------------------------------------------------------------
    | Section: Existing Controller functions
    |--------------------------------------------------------------------------
    */
    // public function datatable() { }
    // public function listJson() { }
    // public function report() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Crud helpers
    |--------------------------------------------------------------------------
    */
    // public function storeRequestValidator() { }
    // public function updateRequestValidator() { }
    // public function saveRequestValidator() { }
    // public function attemptStore() { }
    // public function attemptUpdate() { }
    // public function attemptDestroy() { }
    // public function stored() { }
    // public function updated() { }
    // public function saved() { }
    // public function deleted() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Custom Controller functions
    |--------------------------------------------------------------------------
    */

    /**
     * Immediately send email without queuing
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|void
     */
    public function sendNow(Email $email)
    {
        $email->send();

        return $this->success('Email has been sent')->send();
    }

    /**
     * Queue email for sending
     *
     * @param  Email  $email
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|void
     */
    public function queue(Email $email)
    {
        $email->queue();

        return $this->success('Email has been queued for sending')->send();
    }

    /**
     * Show email HTML preview
     *
     * @param  Email  $email
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View|void
     */
    public function preview(Email $email)
    {
        if (!$this->user->can('view', $email)) {
            return $this->permissionDenied();
        }

        return $this->view(projectKey().'.emails.email')->with(['email' => $email]);
    }
}

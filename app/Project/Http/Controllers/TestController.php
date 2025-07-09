<?php

namespace App\Project\Http\Controllers;

use App\User;
use App\Project\Notifications\Auth\VerifyEmail;
use App\Project\Notifications\Auth\ResetPassword;

class TestController extends BaseController
{

    public function test()
    {
        return;
    }

    /**
     * @param $id
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function previewUserVerifyEmail($id)
    {
        $user = User::find($id);

        return (new VerifyEmail($user))
            ->toMail($user);
    }

    /**
     * @param $id
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function previewUserResetPasswordEmail($id)
    {
        $user = User::find($id);

        return (new ResetPassword($user))
            ->toMail($user);
    }
}

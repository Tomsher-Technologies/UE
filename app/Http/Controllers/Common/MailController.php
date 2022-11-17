<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Mail\Admin\NewCustomerMail;
use App\Models\Common\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function newCustomerRegister($user)
    {
        $to_mail = Cache::rememberForever('notification_email', function () {
            return Settings::where('group', 'notification_email')->get();
        });

        $to_mail = $to_mail->where('name', 'new_user_reg')->first()->value;

        foreach (explode(',', $to_mail) as $email) {
            Mail::to($email)->queue(new NewCustomerMail($user));
        }
    }


    public function agentApprovel($user, $status)
    {
        
    }
}

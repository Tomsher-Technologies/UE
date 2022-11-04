<?php

namespace App\Observers;

use App\Mail\Admin\NewCustomerMail;
use App\Models\Common\Settings;
use App\Models\User;
use App\Notifications\Admin\NewUserNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        if ($user->isA('reseller')) {
            $admin_email = Cache::rememberForever('notification_email', function () {
                return Settings::where('group', 'notification_email')->get();
            });

            $admin_email = $admin_email->where('name', 'new_user_reg')->first()->value;

            $emails = explode(',', $admin_email);

            foreach ($emails as $email) {
                Mail::to($email)->queue(new NewCustomerMail($user));
            }
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if ($user->isA('reseller')) {
            $admin_email = Cache::rememberForever('notification_email', function () {
                return Settings::where('group', 'notification_email')->get();
            });

            $admin_email = $admin_email->where('name', 'new_user_reg')->first()->value;

            $emails = explode(',', $admin_email);

            // Notification::route('mail', 'taylor@example.com')
            //     ->notify(new NewUserNotification($user));

            foreach ($emails as $email) {
                Notification::route('mail', $email)
                    ->notify(new NewUserNotification($user));
                // Mail::to($email)->later(60, new NewCustomerMail($user));
            }
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}

<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Notifications\VerifyEmail;
use Exception;
use Filament\Facades\Filament;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class SendFilamentUserVerificationNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @throws Exception
     */
    public function handle(UserCreated $event): void
    {
        if (! $event->user instanceof MustVerifyEmail) {
            return;
        }

        if ($event->user->hasVerifiedEmail()) {
            return;
        }

        if (! method_exists($event->user, 'notify')) {
            $userClass = $event->user::class;

            throw new Exception("Model [{$userClass}] does not have a [notify()] method.");
        }

        $notification = new VerifyEmail();
        $notification->url = Filament::getVerifyEmailUrl($event->user);

        $event->user->notify($notification);
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail as BaseNotification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class VerifyEmail extends BaseNotification
{

    public string $url;

    protected function verificationUrl($notifiable): string
    {
        return $this->url;
    }

    protected function buildMailMessage($url): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->line(Lang::get('Please click the button below to verify your email address.'))
            ->action(Lang::get('Verify Email Address'), $url)
            ->line(Lang::get('If you did not create an account, no further action is required.'));


//        $name = $notifiable->serviceperson->military_name;
//        $email = $notifiable->email;
//
//        return (new MailMessage)
//            ->subject("Welcome {$name}! Your account has been created.")
//            ->greeting("Hi {$name}!")
//            ->line(new HtmlString("<H2>Welcome to the Trinidad and Tobago Regiment's Serviceperson Management System</H2>"))
//            ->line('Your personal details has been entered and an account was created for you.')
//            ->line('Please login to ensure you details are correct using the link below')
//            ->line('Your login credentials are:')
//            ->line(new HtmlString("<strong> Email: </strong>  {$email}"))
//            ->line(new HtmlString('<strong>Password: </strong> Password1'))
//            ->line(new HtmlString('<strong><em>Please immediately inform your Admin Office if there are any issues.</em></strong>'))
//            ->action(Lang::get('Verify Email Address'), $url)
//            ->line(new HtmlString('<strong><em><u>Note:</u> To ensure the security of you data you will be
//                    required to verify your account and change the default password on first login.</em></strong>'))
//            ->line('We look forward to better serving you!');
    }



}

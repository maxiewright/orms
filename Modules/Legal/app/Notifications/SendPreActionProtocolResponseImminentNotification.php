<?php

namespace Modules\Legal\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;
use Modules\Legal\Models\LegalAction\PreActionProtocol;

class SendPreActionProtocolResponseImminentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Collection $preActionProtocols
    ) {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }




    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pre-Action Protocol Response Imminent')
            ->greeting("Hello {$notifiable->serviceperson->military_name}")
            ->line('The introduction to the notification.')
            ->action('Notification Action', 'https://laravel.com')
            ->line('Thank you for using our application!');
    }

    public function databaseType($notifiable): string
    {
        return 'imminent-response';
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'preActionProtocols' => $this->preActionProtocols->pluck('required_by', 'id'),
        ];
    }
}

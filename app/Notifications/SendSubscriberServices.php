<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendSubscriberServices extends Notification
{
    use Queueable;

    protected $service;
    protected $subscriber;
    /**
     * Create a new notification instance.
     */
    public function __construct($service,$subscriber)
    {
        $this->service = $service;
        $this->subscriber = $subscriber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->greeting('Hello,'.$this->subscriber->subscriber_email)
        ->line('There is a new Service that has been published. We hope you will like it.')
        ->line('Service Title : '.$this->service->getTranslation('name','en'))
        ->action('Click Here',route('website.services.service_content', $this->service->slug))
        ->line('Thank you for using our website!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
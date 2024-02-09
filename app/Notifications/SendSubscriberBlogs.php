<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendSubscriberBlogs extends Notification
{
    use Queueable;

    protected $blog;
    protected $subscriber;
    /**
     * Create a new notification instance.
     */
    public function __construct($blog,$subscriber)
    {
        $this->blog = $blog;
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
        ->line('There is a new Blog that has been published. We hope you will like it.')
        ->line('Blog Title : '.$this->blog->getTranslation('title','en'))
        ->action('Click Here',route('website.blog.blog_content', $this->blog->slug))
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
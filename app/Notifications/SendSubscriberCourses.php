<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendSubscriberCourses extends Notification
{
    use Queueable;

    protected $course;
    protected $subscriber;
    /**
     * Create a new notification instance.
     */
    public function __construct($course,$subscriber)
    {
        $this->course = $course;
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
        ->line('There is a new Course that has been published. We hope you will like it.')
        ->line('Course Title : '.$this->course->getTranslation('name','en'))
        ->action('Click Here',route('website.courses.course_content', $this->course->slug))
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
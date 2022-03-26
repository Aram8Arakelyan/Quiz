<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendToStudents extends Notification
{
    use Queueable;

    private $quizId;
    private $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($quizId, $email)
    {
        $this->quizId = $quizId;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line(auth()->user()->name . " invited to the quiz.")
            ->action('Start quiz', url('/start-quiz/' . $this->email . "/" . $this->quizId))
            ->line('Thank you for using our application!');
    }
}

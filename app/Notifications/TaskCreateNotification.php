<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCreateNotification extends Notification
{
    use Queueable;
    private $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;


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
            ->subject('Your Case Has Been Received!')
            ->greeting('Dear ' . $this->data['customer_name'] . '!')
            ->line('We have successfully received your case and are currently processing it.')
            ->line('Here are the details of your case:')
            ->line('• **Case Number:** ' . $this->data['case_number'])
            ->line('• **Submission Date:** ' . $this->data['date_opened'])
            ->line('• **Case Description:** ' . $this->data['problem_description'])
            ->line('To track your case and get updates, click the button below:')
            ->action('Track Your Case', asset($this->data['tracking_link']))
            ->line('If you need any assistance, feel free to reach out to us at:')
            ->line('• **Email:** ' . $this->data['company_email'])
            ->line('• **Website:** ' . $this->data['company_website'])
            ->line('Thank you for trusting us with your case!');
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

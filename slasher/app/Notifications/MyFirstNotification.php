<?php

namespace App\Notifications;



use Illuminate\Bus\Queueable;

use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;



class MyFirstNotification extends Notification

{

    use Queueable;



    private $details;



    /**

     * Create a new notification instance.

     *

     * @return void

     */

    public function __construct($details)

    {

        $this->details = $details;

    }



    /**

     * Get the notification's delivery channels.

     *

     * @param  mixed  $notifiable

     * @return array

     */

    public function via($notifiable)

    {

        return ['mail','database' , 'nexmo'];

    }



    /**

     * Get the mail representation of the notification.

     *

     * @param  mixed  $notifiable

     * @return \Illuminate\Notifications\Messages\MailMessage

     */

    public function toMail($notifiable)

    {

        return (new MailMessage)

            ->greeting($this->details['greeting'])

            ->line($this->details['body'])

            ->action($this->details['actionText'], $this->details['actionURL'])

            ->line($this->details['thanks']);

    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage())
            ->content('Hello this is from aizaz');
    }



    /**

     * Get the array representation of the notification.

     *

     * @param  mixed  $notifiable

     * @return array

     */

    public function toDatabase($notifiable)

    {

        return [

            'order_id' => $this->details['order_id']

        ];

    }

}
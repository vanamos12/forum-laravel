<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Reply;
use App\Mail\NewReplyEmail;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewReplyNotification extends Notification
{
    use Queueable;

    public $reply;
    public $subscription;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply, Subscription $subscription)
    {
        //
        $this->reply = $reply;
        $this->subscription = $subscription;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail', 'database'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(User $user)
    {
        return (new NewReplyEmail($this->reply, $this->subscription))
                   ->to($user->emailAddress(), $user->name());
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
            //
            'type'    => 'new_reply',
            'reply'   => $this->reply->id(),
            'replyable_id'  => $this->reply->replyable_id,
            'replyable_type' => $this->reply->replyable_type,
            'replyable_subject' => $this->reply->replyAble()->replyAbleSubject(),
         ];
    }
}

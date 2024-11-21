<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EconomicGoalNotification extends Notification
{
    use Queueable;

    public $economic_goal_id;
    public $goal_name;
    public $message;
    public $user_id;
    /**
     * Create a new notification instance.
     */
    public function __construct($economic_goal_id, $goal_name, $message, $user_id)
    {
        $this->economic_goal_id = $economic_goal_id; 
        $this->goal_name = $goal_name;
        $this->message = $message;
        $this->user_id = $user_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable){
        return [
            'economic_goal_id' => $this->economic_goal_id,
            'goal_name' => $this->goal_name,
            'message' => $this->message,
            'user_id' => $this->user_id
        ];
    }
}

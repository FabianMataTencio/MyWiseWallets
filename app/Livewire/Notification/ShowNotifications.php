<?php

namespace App\Livewire\Notification;

use Illuminate\Notifications\Notification;
use Livewire\Component;
use Livewire\Attributes\On;

class ShowNotifications extends Component 
{
    
    protected $listeners = ['deleteNotification'];

    public function deleteNotification($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->delete();
        }
    }  
    
    public function render()
    {
        $notifications = auth()->user()->unreadNotifications;
        $notificationsHistory = auth()->user()->readNotifications;

        auth()->user()->unreadNotifications->markAsRead();

        return view('livewire.notification.show-notifications', [
            'notifications' => $notifications,
            'notificationsHistory' => $notificationsHistory
        ]);
    }
}

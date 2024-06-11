<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use App\Models\notifications;
use Illuminate\Support\Facades\Auth;

class NotificationsHeader extends Component
{

    public $user_notifications;

    public function delete($notification_id){
        
        $notification = notifications::findOrFail($notification_id);

        $notification->seen = 1;
        $notification->save();
    }

    public function render()
    {
        $this->user_notifications = notifications::latest()->where('UID', Auth::id())->where('seen', 0)->get();

        return view('livewire.notifications.notifications-header');
    }
}

<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use App\Models\notifications;
use Illuminate\Support\Facades\Auth;

class NotificationsHeader extends Component
{

    public $user_notifications;

    public function render()
    {
        $this->user_notifications = notifications::latest()->where('UID', Auth::id())->get();

        // $this->user_notifications = notifications::all();

        return view('livewire.notifications.notifications-header');
    }
}

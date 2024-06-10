<?php

namespace App\Livewire\Notifications;

use Livewire\Component;

class NotificationsHeader extends Component
{

    public $x = 0;

    public function refresh(){
        $this->x +=1;
    }
    public function render()
    {
        return view('livewire.notifications.notifications-header');
    }
}

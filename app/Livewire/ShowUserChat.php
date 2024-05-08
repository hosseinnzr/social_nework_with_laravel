<?php

namespace App\Livewire;

use Livewire\Component;

class ShowUserChat extends Component
{

    public $users;
    public function render()
    {
        return view('livewire.chat.show-user-chat');
    }
}

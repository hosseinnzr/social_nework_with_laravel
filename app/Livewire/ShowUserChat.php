<?php

namespace App\Livewire;

use Livewire\Component;

class ShowUserChat extends Component
{

    public $conversations;
    public function render()
    {
        return view('livewire.chat.show-user-chat');
    }
}

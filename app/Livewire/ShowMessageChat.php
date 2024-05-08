<?php

namespace App\Livewire;

use Livewire\Component;

class ShowMessageChat extends Component
{

    public $chat;
    
    public function render()
    {
        return view('livewire.chat.show-message-chat');
    }
}

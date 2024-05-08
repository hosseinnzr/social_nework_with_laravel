<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\conversations;
use Illuminate\Http\Request;
use App\Models\messages;
use App\Models\User;

class ShowMessageChat extends Component
{

    public $conversations;


    public function render()
    {
        return view('livewire.chat.show-message-chat');
    }
}

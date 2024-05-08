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

    public $loadedMessages;
    public $message;

    public $userId;

    public function save($user_in_chat){
        dd($user_in_chat);
        if(conversations::findOrFail($user_in_chat)->sender_id == auth::id()){
            $receiver_id = conversations::findOrFail($user_in_chat)->receiver_id;
        }else{
            $receiver_id = conversations::findOrFail($user_in_chat)->sender_id;
        }

        dd();
        $createdMessage = messages::create([
            'user_in_chat' => $user_in_chat,
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver_id,
            'body' => $this->message

        ]);

    }



    public function render()
    {
        $userId = $this->userId;
        $this->loadedMessages = messages::
            where('sender_id', $userId)->orWhere('receiver_id', $userId)->get();

        return view('livewire.chat.show-message-chat',[
            'loadedMessages' => $this->loadedMessages,
        ]);
    }
}

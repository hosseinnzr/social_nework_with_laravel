<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\messages;
use Illuminate\Support\Facades\Auth;
use App\Models\conversations;

class ShowUserChat extends Component
{

    public $conversations;

    public $user_in_chat;
    public $conversation_id;
    public $chat_result;
    public $message;

    public $show_messages;

    public function save($user_in_chat){

        $createdMessage = messages::create([
            'conversation_id' => $this->conversation_id,
            'sender_id' => auth()->id(),
            'receiver_id' => $user_in_chat,
            'body' => $this->message

        ]);
        
        if($createdMessage){
            $this->show_messages = messages::where('conversation_id', $this->conversation_id)->get();
        }
    }

    public function result($conversation_id){
        $this->conversation_id = $conversation_id;

        if(conversations::findOrFail($conversation_id)->sender_id == auth::id()){
            $user_in_chat = conversations::findOrFail($conversation_id)->receiver_id;
        }else{
            $user_in_chat = conversations::findOrFail($conversation_id)->sender_id;
        }

        $this->user_in_chat = $user_in_chat;

        $this->chat_result = conversations::where('id', $conversation_id)->get();
        $this->show_messages = messages::where('conversation_id', $conversation_id)->get();

    }

    public function render()
    {
        $Id = auth::id();

        $this->conversations = conversations::where('sender_id', $Id)->orWhere('receiver_id', $Id)->get();

        return view('livewire.chat.show-user-chat');
    }
}

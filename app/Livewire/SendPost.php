<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class SendPost extends Component
{
    public $search = "";

    public $select_user_id = [];

    public $select_user_info = [];
    public $result = [];


    public function send(){
        dd($this->select_user_id);
    }

    public function selectUser($id){
        array_push($this->select_user_id, $id);

        $user_info = user::findOrFail($id);
        array_push($this->select_user_info, $user_info);

        $this->search = "";
    }

    public function deSelectUser($id){
        $this->select_user_id = array_diff($this->select_user_id, array($id));

        $this->select_user_info = [];
        
        foreach($this->select_user_id as $id){
            $user_info = user::findOrFail($id);
            array_push($this->select_user_info, $user_info);
        }
    }

    public function render()
    {

        if(strlen($this->search) >= 2){
            $this->result = User::where('user_name', 'like', '%'.$this->search.'%')->limit(6)->get();
        }else{
            $this->result = [];
        }

        return view('livewire.send-post', [
            'users' => $this->result,
        ]);
    }
}

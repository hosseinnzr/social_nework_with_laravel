<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchBar extends Component
{

    public $search = "";

    public function render()
    {
        $result = [];

        if(strlen($this->search) >= 2){
            $result = User::where('user_name', 'like', '%'.$this->search.'%')->limit(6)->get();
        }

        return view('livewire.search-bar', [
            'users' => $result
        ]);
    }
}

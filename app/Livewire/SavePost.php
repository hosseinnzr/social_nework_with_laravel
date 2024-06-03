<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Livewire\Component;

class SavePost extends Component
{
    public $postId;
    public function savepost(){

        $saved = false;

        $user = User::findOrFail(auth::id());
        $postId = $this->postId;

        // Read save post from dataBase
        $user_save_post = $user->save_post;
        $user_save_post_array = explode(",", $user_save_post);

        foreach($user_save_post_array as $save_post_id){
            if ($postId == $save_post_id){

                // delete save  
                $user_save_post_array = array_diff($user_save_post_array, array($save_post_id));
                
                $user_save_post = implode(",", $user_save_post_array);

                $saved = true;
                break;
            }
        }

        if(!$saved){
            $user_save_post = $user->save_post . ',' . $this->postId;
        }

        // update save_post
        $user->save_post = $user_save_post;
        $user->save();
        
        notify()->success('you are now signin');

        return back();
    }

    public function render()
    {
        return view('livewire.save-post');
    }
}

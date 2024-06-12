<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\notifications;
use Livewire\Component;

class LikePost extends Component
{
    public $post;

 
    public function like($post)
    {
        $id = $post['id'];
        $is_liked = false;
        $user_liked_id = auth::id();

        $post = Post::findOrFail($id);
        $post_like = $post->like;

        $post_liked_array = explode(",", $post_like);

        foreach($post_liked_array as $like_number){

            if ($user_liked_id == $like_number){
                $post_liked_array = array_diff($post_liked_array, array($like_number));
                $like = implode(",", $post_liked_array);
                $is_liked = true;
                break;
            }
        }

        if(!$is_liked){
            if ($post->like != NULL) {
                $like = $post->like . ',' . $user_liked_id;
            } else {
                $like = $post->like . $user_liked_id;   
            }

            // send notifiction
            if($post->UID != Auth::id()){
                notifications::create([
                    'UID' => $post->UID,
                    'body' => Auth::user()->user_name,
                    'type'=> 'like',
                    'url' => "/p/$post->id",
                    'user_profile' => Auth::user()->profile_pic,
                ]);
            }
        }

        // save like
        $post->like = $like;
        $post->save();

            if ($post->like == ""){
                $like_number = 0;
            }else{
                $like_number = count(explode(",", $post->like));
            }
        
        // save like_number
        $post->like_number = $like_number;
        $post->save();

        $this->post['like_number'] = $post->like_number;

        }

    public function render()
    {
        return view('livewire.like-post');
    }
}

<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\notifications;
use Livewire\Component;

class LikePost extends Component
{
    public $post;

    public $liked;

    public function like($post)
    {
        $id = $post['id'];
        $user_liked_id = auth::id();

        $post = Post::findOrFail($id);

        if ($post->like != NULL) {
            $like = $post->like . ',' . $user_liked_id;
        } else {
            $like = $user_liked_id;   
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

        // save like
        $post->like = $like;

            if ($post->like == ""){
                $like_number = 0;
            }else{
                $like_number = count(explode(",", $post->like));
            }
        
        // save like_number
        $post->like_number = $like_number;
        $post->save();

        $this->post['like_number'] = $post->like_number;
        $this->liked = 1;

    }


    public function dislike($post){
        $this->liked = 0;

        $id = $post['id'];
        $user_liked_id = auth::id();

        $post = Post::findOrFail($id);
        $post_like = $post->like;

        $post_liked_array = explode(",", $post_like);

        $like = 0;

        foreach($post_liked_array as $like_number){

            if ($user_liked_id == $like_number){
                $post_liked_array = array_diff($post_liked_array, array($like_number));
                $like = implode(",", $post_liked_array);
                break;
            }
        }

        // save like
        $post->like = $like;

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
        if(in_array(Auth::id(), explode(",", $this->post['like']))){
            $this->liked = 1;
        }else{
            $this->liked = 0;
        }

        return view('livewire.like-post');
    }
}

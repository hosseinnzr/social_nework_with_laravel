<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;

class AddComments extends Component
{

    public $comment;

    public $postId;

    public $post;

    public $post_comments;

    public $single_comment;

    public $error;

    public $amount = 5;

    public function save($postId){
        $input = [
            'UID' => Auth::id(),
            'post_id' => $postId,
            'comment_value' => $this->comment,
            'like' => '0',
            'like_number' => '0',
            'user_profile' => Auth::user()->profile_pic ,
            'user_name' => Auth::user()->user_name 
        ];

        if($input['comment_value'] != null){
            Comments::create($input);
        }
    }

    public function loadMore(){
        $this->amount += 5;
    }

    public function like($single_comment)
    {
        $id = $single_comment['id'];
        $is_liked = false;
        $user_liked_id = auth::id();

        $comment = comments::findOrFail($id);
        $comment_like = $comment->like;

        $comment_liked_array = explode(",", $comment_like);

        foreach($comment_liked_array as $like_number){

            if ($user_liked_id == $like_number){
                $post_liked_array = array_diff($comment_liked_array, array($like_number));
                $like = implode(",", $post_liked_array);
                $is_liked = true;
                break;
            }
        }

        if(!$is_liked){
            $like = $comment->like .','. $user_liked_id;   
        }

        // save like
        $comment->like = $like;
        $comment->save();

            if ($comment->like == ""){
                $like_number = 0;
            }else{
                $like_number = count(explode(",", $comment->like)) -1;
            }
        
        // save like_number
        $comment->like_number = $like_number;
        $comment->save();

        $this->single_comment['like_number'] = $comment->like_number;

    }
    public function render()
    {
        $this->post_comments = comments::latest()->where('post_id', $this->postId)->limit($this->amount)->get();

        return view('livewire.add-comments',[
            'post_comments' => $this->post_comments,
        ]);
    }
}

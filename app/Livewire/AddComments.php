<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;

class AddComments extends Component
{

    public $comment;

    public $postId;

    public $post_comments;

    public function save($postId)
    {
        $input = [
            'UID' => Auth::id(),
            'post_id' => $postId,
            'comment_value' => $this->comment,
            'like' => '0',
            'like_number' => '0',
            'user_profile' => Auth::user()->profile_pic ,
            'user_name' => Auth::user()->user_name 
        ];

        $comment = Comments::create($input);

    }

    public function render()
    {
        $this->post_comments = comments::latest()->where('post_id', $this->postId)->get();

        return view('livewire.add-comments',[
            'post_comments' => $this->post_comments,
        ]);
    }
}

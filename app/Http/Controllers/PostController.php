<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{   
    
    public function home(Request $request){
        if(auth::check()){
            $posts = Post::latest()->where('delete', 0)->get();

            if(isset($request->tag)){
                $result = array();
                foreach ($posts as $post) {
                    $post_array = explode(',', $post['tag']);
                    if ((in_array($request->tag, $post_array)) != false){
                        array_push($result, $post);
                    }
                    $posts=$result;
                } 
            }
    
            foreach ($posts as $post) {
                $user = User::where('id', $post->UID)->select('user_name')->first();
                $post['user_name'] = $user ? $user->user_name : null;
            }

            return view('home', ['posts' => $posts]);    
        } else {
            notify()->error('you not login');
            return redirect()->route('login');
        }
    }


    public function postRoute(Request $request){
        if(isset($request->id)){
            $post = Post::findOrFail($request->id);

            if(Auth::user()->id != $post['UID']){
                notify()->error('you do not have access');
                return back();
            }else{
                return view('post', ['post' => $post]);
            }

        }else{
            return view('post');
        }
    }
    public function create(Request $request){
            
        if (Auth::check()) {
            $inputs = $request->only([
                'UID',
                'title',
                'post',
                'tag',
                'delete',
            ]);

            $inputs['UID'] = Auth::id();

            $post = Post::create($inputs);

            notify()->success('Add post successfully!');
          
            return redirect()->route('post', ['id'=> $post->id])
              ->with('success', true);

        }else{
            return redirect()->route('/login');
        }
    }

    
    public function update(Request $request){

        if (isset($request->id)) {
            $inputs = $request->only([
                'title',
                'post',
                'tag',
            ]);
            // dd($inputs);
            $post = Post::findOrFail($request->id);

            $post->update($inputs);

            notify()->success('update post successfully!');
          
            return redirect()->route('post', ['id'=> $post->id])
              ->with('success', true);

        }else{
            return redirect()->route('/login');
        }

    }

    public function delete($id){

        $post = Post::findOrFail($id);
        $post->update(['delete' => true]);
        return redirect()->route('home');

    }

    public function like($id){
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

        return back();

    }
}

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
            return redirect()->route('login');
        }
    }


    public function create(Request $request){
                
        if (Auth::check()) {

            $inputs = $request->only([
                'UID',
                'title',
                'post',
                'hashtag',
                'delete',
            ]);

            $inputs['UID'] = Auth::id();

            try {
                Post::create($inputs);
                return redirect()->route('home');
            } catch (Exception $error) {
                return redirect(route('addPost'))->with('error', 'complate reqired fild');
                // return Response()->json(['status'=> 401, 'message'=> 'Error'], 401);
            }
        }else{
            return redirect()->route('/login');
        }
    }

    // edit updatew update
    public function update(){
        return redirect()->route('edit');
    }
    public function updatePost(Request $request, $id){
        $inputs = $request->only([
            'UID',
            'fistname_name',
            'last_name',
            'phone',
            'adress',
            'gender'
        ]);;

        try {
            $post = Post::findOrFail($id) -> update($inputs);

            if($post){
                return Response()->json('the post updated successfuly', 200); 
            }else{
                return Response()->json('Updating the post ins failed!',401);
            }
        } catch (Exception $error) {
            return Response()->json($error, 400);
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

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use App\Models\story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PostController extends Controller
{   

    public function home(Request $request){
        if(auth::check()){

            $user_following = explode(",", Auth::user()->following);
            $user_follower = explode(",", Auth::user()->followers);

            $signin_user_id = Auth::id();

            $new_users = User::all()->sortByDesc('id')->whereNotIn('id', $user_following)->whereNotIn('id', $user_follower)->where('id', '!=', $signin_user_id)->take(5);

            $posts = Post::latest()->where('delete', 0)->whereIn('UID', $user_following)->get();

            $hash_tag = null;

            $storys = story::orderBy('id')->select('id', 'UID')->groupBy('UID')->get();

            // $storys = DB::table('story')->orderBy('id')->select('id', 'UID')->groupBy('UID')->get();

            foreach ($storys as $story) {
                $user = User::where('id', $story->UID)->select('user_name', 'profile_pic')->first();
                $story['user_name'] = $user['user_name'];
                $story['user_profile_pic'] = $user['profile_pic'];
            }

            if(isset($request->tag)){
                $hash_tag = $request->tag;
                $result = array();
                foreach ($posts as $post) {
                    $post_array = explode(',', $post['tag']);
                    if ((in_array('#'.$request->tag, $post_array)) != false){
                        array_push($result, $post);
                    }
                    $posts=$result;
                } 
            }
            
            foreach ($posts as $post) {
                $user = User::where('id', $post->UID)->select('id', 'user_name', 'profile_pic')->first();
                $post['user_id'] = $user['id'];
                $post['user_name'] = $user['user_name'];
                $post['user_profile_pic'] = $user['profile_pic'];
            }

            $follower_user = User::whereIn('id', $user_follower)->select('user_name', 'first_name', 'last_name', 'profile_pic')->get();
            $following_user = User::whereIn('id', $user_following)->select('user_name', 'first_name', 'last_name', 'profile_pic')->get();

            return view('home.home', [
                'hash_tag' => $hash_tag,
                'posts' => $posts,
                'follower_user' => $follower_user,
                'following_user' => $following_user,
                'new_users' => $new_users,
                'storys' => $storys,
            ]);    
            
        } else {
            return redirect()->route('signin');
        }
    }

    public function viewPost($id){

        $post = post::findOrFail($id);

        $user = User::where('id', $post->UID)->select('id', 'user_name', 'profile_pic')->first();
        $post['user_id'] = $user['id'];
        $post['user_name'] = $user['user_name'];
        $post['user_profile_pic'] = $user['profile_pic'];

        return view('posts.viewPost', ['post' => $post]);
    }

    public function postRoute(Request $request,){
        if(isset($request->id)){
            $post = Post::findOrFail($request->id);

            if(Auth::user()->id != $post['UID']){
                notify()->error('you do not have access');
                return back();
            }else{
                return view('posts.post', ['post' => $post]);
            }

        }else{
            return view('posts.post');
        }
    }
    
    public function create(Request $request){
            
        if (Auth::check()) {

            $request->validate([
                'post' => 'required',
            ]);

            $inputs = $request->only([
                'post_picture',
                'UID',
                'title',
                'post',
                'tag',
            ]);

            if ($request->hasFile('post_picture')) {
                $image = $request->file('post_picture');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // create image manager with desired driver
                $manager = new ImageManager(new Driver());

                // Load image using Intervention Image
                $img = $manager->read($image);

                // Get dimensions to calculate cropping coordinates
                $width = $img->width();
                $height = $img->height();
                $size = min($width, $height);
                $x = ($width - $size) / 2;
                $y = ($height - $size) / 2;

                // Crop the image to a square
                $img->crop($size, $size, $x, $y);

                // Save the image to the public directory
                $img->save(public_path('post-picture/' . $imageName));

                $inputs['post_picture'] = '/post-picture/' . $imageName;
            }

            $inputs['UID'] = Auth::id();
            $post = Post::create($inputs);

            // update user post number
            $signin_user_post_number = Post::where('delete', 0)->where('UID', Auth::id())->count();
            $user = User::findOrFail(Auth::id());
            $user->post_number = $signin_user_post_number;
            $user->save();

            // Organize hash tag
            $inputs['tag'] = substr(str_replace(',,', ',', str_replace('#', ',#',str_replace(' ', '', $inputs['tag']))), 1);

            notify()->success('Add post successfully!');
          
            return redirect()->route('post.store', ['id'=> $post->id])
              ->with('success', true);

        }else{
            return redirect()->route('/signin');
        }
    }

    
    public function update(Request $request){

        if (isset($request->id)) {
            
            $request->validate([
                'post' => 'required',
            ]);

            $inputs = $request->only([
                'post_picture',
                'title',
                'post',
                'tag',
            ]);

            if ($request->hasFile('post_picture')) {
                $image = $request->file('post_picture');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // create image manager with desired driver
                $manager = new ImageManager(new Driver());

                // Load image using Intervention Image
                $img = $manager->read($image);

                // Get dimensions to calculate cropping coordinates
                $width = $img->width();
                $height = $img->height();
                $size = min($width, $height);
                $x = ($width - $size) / 2;
                $y = ($height - $size) / 2;

                // Crop the image to a square
                $img->crop($size, $size, $x, $y);

                // Save the image to the public directory
                $img->save(public_path('post-picture/' . $imageName));

                $inputs['post_picture'] = '/post-picture/' . $imageName;
            }

            // Organize hash tag
            $inputs['tag'] = substr(str_replace(',,', ',', str_replace('#', ',#',str_replace(' ', '', $inputs['tag']))), 1);


            $post = Post::findOrFail($request->id);
            $post->update($inputs);

            notify()->success('Update post successfully!');

            return redirect()
                ->route('post', ['id' => $post->id])
                ->with('success', true);
        } else {
            return redirect()->route('/signin');
        }

    }

    public function delete(Request $request){
        $post = Post::findOrFail($request->id);
        $post->update(['delete' => true]);

        // update user post number
        $signin_user_post_number = Post::where('delete', 0)->where('UID', Auth::id())->count();
        $user = User::findOrFail(Auth::id());
        $user->post_number = $signin_user_post_number;
        $user->save();
        
        return redirect()->back();
    }

    public function like(Request $request){

        $id = $request->postId;
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

        return response()->json(['massage'=> $like_number]);

        // return back();

    }
}

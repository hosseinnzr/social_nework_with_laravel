<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Exception;



class AuthManager extends Controller
{

    function profile(Request $request){
        if(auth::check()){
            $posts = Post::latest()->where('delete', 0)->where('UID', auth::id())->get();
            $user = Auth::user();

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
    
            // foreach ($posts as $post) {
            //     $user = User::where('id', $post->UID)->select('user_name')->first();
            //     $post['user_name'] = $user ? $user->user_name : null;
            // }

            return view('profile', ['posts' => $posts, 'user' => $user]);    
        } else {
            notify()->error('you not login');
            return redirect()->route('login');
        }
    }

    function login(){
        if(auth::check()){
            notify()->success('you are now login');
            return redirect()->route('home');  
        }else{
            return view('login');
        }
    }

    function loginPost(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            notify()->success('login successfully');
            return redirect()->route('home');
        }
        return redirect(route('login'))->with('error', 'login details are not valid');
    }

    function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
         
        return view('/login');
    }
    
    
    function signup(){
        return view('signUp');
    }

    public function signupPost(Request $request){

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['user_name'] = $request->user_name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        if(!$user){
            return redirect(route('home'))->with('error', 'registration fiald, try again');
        }
        return redirect(route('home'))->with('success', 'registration successfully ');
    }

    // edit / update
    public function setting(){
        return view('settings');
    }
    public function settingPost(Request $request, $id){

        $inputs = $request->only([
            'biography',
            'first_name',
            'last_name',
            'user_name',
            'email',
        ]);;

        $inputs['password'] = Hash::make($request->password);

        try {
            $sesult = user::findOrFail($id) -> update($inputs);
            if($sesult){
                return redirect(route('home'))->with('massage', 'he user updated successfuly - 200');
            }else{
                return Response()->json('Updating the user in failed!',401);
            }
        } catch (Exception $error) {
            return Response()->json($error, 400);
        }
    }
    public function delete($id){
        try {
            $status = Post::where(['id' => $id]) -> delete();

            if($status){
                $result = "the post id : $id delete successfuly";
                return Response()->json( $result , 200); 
            }else{
                $result = "Delteing the post id : $id is failed!";
                return Response()->json( $result ,401);
            }
        } catch (Exception $error) {
            return Response()->json($error, 400);
        }
    }

    // follow
    public function follow($id){
        $is_follow = false;
        $user_login = auth::user();
        $user = User::findOrFail($id);

        $user_followers = $user->followers;
        $user_login_id_following = auth::user()->following;

        $user_follower_array = explode(",", $user_followers);
        $user_login_id_following_array = explode(",", $user_login_id_following);

        foreach($user_follower_array as $followers_number){
            if ($user_login->id == $followers_number){
                // delete follower
                $user_follower_array = array_diff($user_follower_array, array($followers_number));
                // delete following
                $user_login_id_following_array = array_diff($user_login_id_following_array, array($followers_number));

                $followers = implode(",", $user_follower_array);
                $followings = implode(",", $user_login_id_following_array);

                $is_follow = true;
                break;
            }
        }

        if(!$is_follow){
            $followers = $user->followers . ',' . $user_login->id;
            $followings = $user_login->following . ',' . $user_login->id;   
        }

        // save follow
        $user->followers = $followers;
        $user_login->following = $followings;

        $user_login->save();
        $user->save();

            if ($user->followers == "0"){
                $followers_number = 1;
            }else{
                $followers_number = count(explode(",", $user->followers));
            }

            if ($user_login->following == "0"){
                $following_number = 1;
            }else{
                $following_number = count(explode(",", $user->followers));
            }
        
        $user->followers_number = $followers_number -1;
        $user_login->following_number = $following_number -1;

        $user_login->save();
        $user->save();

        return back();

    }
}

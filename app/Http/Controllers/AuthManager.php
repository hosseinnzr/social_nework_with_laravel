<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\notifications;
use Exception;




class AuthManager extends Controller
{
    function profile(Request $request, $user_name){
        if(auth::check()){
            if(User::where('user_name', $user_name)->exists()){
                $user = User::where('user_name', $user_name)->first();
                $posts = Post::latest()->where('delete', 0)->where('UID', $user->id)->get();

                $save_posts_id = explode(',', $user->save_post);
                $save_posts = Post::latest()->whereIn('id', $save_posts_id)->get();


                foreach ($save_posts as $save_post) {
                    $find_user = User::where('id', $save_post->UID)->select('id', 'user_name', 'profile_pic')->first();
                    $save_post['user_id'] = $find_user['id'];
                    $save_post['user_name'] = $find_user['user_name'];
                    $save_post['user_profile_pic'] = $find_user['profile_pic'];
                }

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

                $user_follower = explode(",", $user->followers);
                $user_following = explode(",", $user->following);

                $follower_user = User::whereIn('id', $user_follower)->select('user_name', 'first_name', 'last_name', 'profile_pic')->get();
                $following_user = User::whereIn('id', $user_following)->select('user_name', 'first_name', 'last_name', 'profile_pic')->get();

                // dd($user);
                
                return view('profile', [
                    'save_posts' => $save_posts,
                    'posts' => $posts,
                    'user' => $user,
                    'follower_user' => $follower_user,
                    'following_user' => $following_user,
                ]);   

            }else{
                notify()->error('user not found');
                return back();
            }
                 
        } else {
            notify()->error('you not signin');
            return redirect()->route('signin');
        }
    }

    // signin / signUp / logout
    function signin(){
        if(auth::check()){
            notify()->success('you are now signin');
            return redirect()->route('home');  
        }else{
            return view('signin');
        }
    }

    function signinPost(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            notify()->success('signup successfully');
            return redirect()->route('home');
        }
        return redirect(route('signin'))->with('error', 'signin details are not valid');
    }

    // public function signupPost(Request $request){ 

    //     $request->validate([
    //         'profile_pic',
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'user_name' => 'required|unique:users',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required',
    //     ]);

    //     $data['first_name'] = $request->first_name;
    //     $data['last_name'] = $request->last_name;
    //     $data['user_name'] = $request->user_name;
    //     $data['email'] = $request->email;
    //     $data['password'] = Hash::make($request->password);
    //     $data['profile_pic'] = '/default/default_profile.jpg';

    //     $user = User::create($data);
    //     if($user){
    //         notify()->success('signup user successfully!');
    //         return redirect(route('signin'));
    //     }
    //     return redirect()->back();
    // }  #### Written by Livw Wire ####
 
    function signup(){
        if(auth::check()){
            notify()->success('you are now signin');
            return redirect()->route('home');  
        }else{
            return view('signup');
        }
    }

    function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        notify()->success('signout user successfully!');
         
        return redirect()->route('signin');
    }
    
    // forgot password
    public function forgotPassword(){
        if(Auth::check()){
            return redirect()->route('home');
        }else{
            return view('forgotPassword');
        }
    } 

    // edit / update
    public function settings(){
        return view('settings');
    }
    public function update(Request $request){

        $userId = Auth::id();

        $user =  User::findOrFail($userId);

        $request->validate([
            'user_name' => 'required|unique:users,user_name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|max:11|unique:users,phone,' . $user->id,
        ]);

        $input = $request->only([
            'birthday',
            'profile_pic' ,
            'biography',
            'birthday',
            'first_name',
            'last_name',
            'user_name',
            'email',
            'phone',
            'additional_name'
        ]);

        if ($request->hasFile('profile_pic')) {
            $image = ($request->file('profile_pic'));
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('profile'), $imageName);
            $input['profile_pic'] = '/profile/'.$imageName;
        }

        $user->update($input);

        notify()->success('update user successfully!');
        return redirect()->route('settings');
        
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
    
    //     $this->validate($request, [
    //         'current_password' => 'required|string',
    //         'new_password' => 'required|confirmed|min:4|string'
    //     ]);

    //     $auth = Auth::user();

    //     // The passwords matches
    //         if (!Hash::check($request->get('current_password'), $auth->password)) 
    //         {
    //             notify()->error('Current Password is Invalid');
    //             return back();
    //         }
    
    //     // Current password and new password same
    //         if (strcmp($request->get('current_password'), $request->new_password) == 0) 
    //         {
    //             notify()->error('New Password cannot be same as your current password.');
    //             return back();
    //         }
    
    //         $user =  User::find($auth->id);
    //         $user->password =  Hash::make($request->new_password);
    //         $user->save();
    //         notify()->success('Password Changed Successfully');
    //         return back();       
    // }


    // follow
    public function follow($id){ 
        $is_follow = false;
        $user_signin = User::findOrFail(auth::id());
        $user = User::findOrFail($id);

        $user_signin_id_following = $user_signin->following;
        $user_followers = $user->followers;

        $user_signin_id_following_array = explode(",", $user_signin_id_following);
        $user_follower_array = explode(",", $user_followers);

        foreach($user_follower_array as $followers_number){
            if ($user_signin->id == $followers_number){
                // delete follower  
                $user_follower_array = array_diff($user_follower_array, array($followers_number));
                // delete following
                $user_signin_id_following_array = array_diff($user_signin_id_following_array, array($user->id));

                $followers = implode(",", $user_follower_array);
                $followings = implode(",", $user_signin_id_following_array);

                $is_follow = true;
                break;
            }
        }

        if(!$is_follow){
            $followers = $user->followers . ',' . $user_signin->id;
            $followings = $user_signin->following . ',' . $user->id;
            
            // send notifiction
            notifications::create([
                'UID' => $user->id,
                'body' => Auth::user()->user_name,
                'type'=> 'follow',
                'url' => '/post/$post->UID',
                'user_profile' => Auth::user()->profile_pic,
            ]);
        }

        // save follow
        $user_signin->following = $followings;
        $user->followers = $followers;

        $user_signin->save();
        $user->save();

        if ($user->followers == "0"){
            $followers_number = 1;
        }else{
            $followers_number = count(explode(",", $user->followers));
        }

        if ($user_signin->following == "0"){
            $following_number = 1;
        }else{
            $following_number = count(explode(",", $user_signin->following));
        }
        
        $user->followers_number = $followers_number -1;
        $user_signin->following_number = $following_number -1;

        $user_signin->save();
        $user->save();

        return back();

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Exception;
use Illuminate\Support\Str;




class AuthManager extends Controller
{
    function profile(Request $request, $user_name){
        if(auth::check()){
            if(User::where('user_name', $user_name)->exists()){
                $user = User::where('user_name', $user_name)->first();
                $posts = Post::latest()->where('delete', 0)->where('UID', $user->id)->get();

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


                return view('profile', [
                    'posts' => $posts,
                    'user' => $user,
                    'follower_user' => $follower_user,
                    'following_user' => $following_user
                ]);   

            }else{
                notify()->error('user not found');
                return back();
            }
                 
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

        notify()->success('logout user successfully!');
         
        return redirect()->route('login');
    }
    
    
    function signup(){
        return view('signUp');
    }

    public function signupPost(Request $request){

        $request->validate([
            'profile_pic',
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['user_name'] = $request->user_name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['profile_pic'] = '/default/default_profile.jpg';

        $user = User::create($data);
        if(!$user){
            notify()->success('signup user successfully!');
            return redirect(route('login'));
        }
        return redirect()->back();
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
            $imageName = $imageName = time().'.'.$image->getClientOriginalExtension();
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

    // follow
    public function follow($id){
        $is_follow = false;
        $user_login = User::findOrFail(auth::id());
        $user = User::findOrFail($id);

        $user_login_id_following = $user_login->following;
        $user_followers = $user->followers;

        $user_login_id_following_array = explode(",", $user_login_id_following);
        $user_follower_array = explode(",", $user_followers);

        foreach($user_follower_array as $followers_number){
            if ($user_login->id == $followers_number){
                // delete follower  
                $user_follower_array = array_diff($user_follower_array, array($followers_number));
                // delete following
                $user_login_id_following_array = array_diff($user_login_id_following_array, array($user->id));

                $followers = implode(",", $user_follower_array);
                $followings = implode(",", $user_login_id_following_array);

                $is_follow = true;
                break;
            }
        }

        if(!$is_follow){
            $followers = $user->followers . ',' . $user_login->id;
            $followings = $user_login->following . ',' . $user->id;   
        }

        // save follow
        $user_login->following = $followings;
        $user->followers = $followers;

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
            $following_number = count(explode(",", $user_login->following));
        }
        
        $user->followers_number = $followers_number -1;
        $user_login->following_number = $following_number -1;

        $user_login->save();
        $user->save();

        return back();

    }
}

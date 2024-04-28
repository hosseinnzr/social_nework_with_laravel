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
            $user = User::where('user_name', $request->user_name)->first();

            if(isset($request)){
                $user_id = $user->id;
            }else{
                $user_id = null;
            }

            $posts = Post::latest()->where('delete', 0)->where('UID', $user_id)->get();
            
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
            
            return view('profile', ['posts' => $posts, 'user' => $user]);    
        }else{
            return view('login');
        }
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            return redirect()->route('home');
        }
        return redirect(route('login'))->with('error', 'login details are not valid');
    }

    function logout(){
        Auth::logout();
        return view('login');
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
    public function update(User $user){
        return view('edit', ['user' => $user]);
    }
    public function updateUser(Request $request, $id){

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
        $user_login_id = auth::id();
        $user = User::findOrFail($id);

        $user_followers = $user->followers;

        $user_follower_array = explode(",", $user_followers);

        foreach($user_follower_array as $followers_number){
            if ($user_login_id == $followers_number){
                $user_follower_array = array_diff($user_follower_array, array($followers_number));
                $followers = implode(",", $user_follower_array);
                $is_follow = true;
                break;
            }
        }

        if(!$is_follow){
            if ($user->followers != NULL) {
                $followers = $user->followers . ',' . $user_login_id;
            } else {
                $followers = $user->followers . $user_login_id;   
            }
        }

        // save follow
        $user->followers = $followers;
        $user->save();

            if ($user->followers == ""){
                $followers_number = 0;
            }else{
                $followers_number = count(explode(",", $user->followers));
            }
        
        $user->followers_number = $followers_number-1;
        $user->save();

        return back();

    }
}

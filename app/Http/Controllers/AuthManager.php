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
    function login(){
        if(auth::check()){
            $user_id = auth::user()->id;
            $user = auth::user();
            $posts = Post::where('delete', 0)->where('UID', $user_id)->get();
        
            return view('Dashboard', ['posts' => $posts, 'user' => $user]);    
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
            $user_id = auth::user()->id;
            $user = Auth::user();
            $posts = Post::where('delete', 0)->where('UID', $user_id)->get();
            return view('Dashboard', ['user' => $user, 'posts' => $posts]);
        }
        return redirect(route('login'))->with('error', 'login details are not valid');
    }

    function logout(){
        Auth::logout();
        return redirect(route('login'));
    }
    
    public function select($id){
       //
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
            return redirect(route('Dashboard'))->with('error', 'registration fiald, try again');
        }
        return redirect(route('Dashboard'))->with('success', 'registration successfully ');
    }

    // edit / update
    public function update(User $user){
        // dd($user);
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

        // $inputs['password'] = Hash::make($request->password);

        try {
            $sesult = user::findOrFail($id) -> update($inputs);
            if($sesult){
                return redirect(route('Dashboard'))->with('massage', 'he user updated successfuly - 200');
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
}

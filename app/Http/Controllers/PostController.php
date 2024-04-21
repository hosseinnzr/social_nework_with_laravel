<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class PostController extends Controller
{

    public function index(Request $request){
        
        if(auth::check()){
            $filters = $request->only(["UID"]);
        
            if (count($filters) == 0){
                $posts = Post::where('delete', 0)->get();
            } else {
                $posts = Post::where($filters)->get();
            }
        
            return view('Dashboard', ['posts' => $posts]);    
        }else{
            return redirect()->route('login');
        }
    }

    public function indexAll(Request $request){
        
        if(auth::check()){
        
                $posts = Post::where('delete', 0)->get();
        
            return view('Dashboard', ['posts' => $posts]);    
        }else{
            return redirect()->route('login');
        }
    }

    public function create(Request $request){
                
        if (Auth::check()) {

            $inputs = $request->only([
                'UID',
                'first_name',
                'last_name',
                'email',
                'phone',
                'address',
                'gender'
            ]);

            $inputs['UID'] = Auth::id();

            try {
                Post::create($inputs);
                return redirect()->route('Dashboard');
                // return Response()->json(['status'=> 200, 'message'=> 'اطلاعات با موفقیت ثبت شد'], 200);
            } catch (Exception $error) {
                return Response()->json(['status'=> 401, 'message'=> 'Error'], 401);
            }
        }else{
            return Response()->json(['status'=> 401, 'message'=> 'please login'], 401);
        }
    }

    public function update(Request $request, $id){
        //return Response()->json($request, 400); 
        $inputs = $request->only([
            'UID',
            'fistname_name',
            'last_name',
            'phone',
            'adress',
            'gender'
        ]);;

        try {
            //$post = Post::where(['id' => $id]) -> update($inputs);
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
        return redirect()->route('Dashboard');

        // if(Post::find($id)){
        //     $post = Post::findOrFail($id);
        //     $post->update(['delete' => '1']);
        //     return redirect()->route('Dashboard');
        // }else{
        //     return Response()->json(400);
        // }
    }

}

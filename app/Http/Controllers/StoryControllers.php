<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\story;

use Illuminate\Http\Request;

class StoryControllers extends Controller
{
    public function show(Request $request){
        if(auth::check()){
            $show_story = story::all();
        
            foreach ($show_story as $story) {
                $user = User::where('id', $story->UID)->select('id', 'user_name', 'first_name', 'last_name', 'profile_pic')->first();
                $story['user_id'] = $user['id'];
                $story['user_name'] = $user['user_name'];
                $story['first_name'] = $user['first_name'];
                $story['last_name'] = $user['last_name'];
                $story['user_profile_pic'] = $user['profile_pic'];
            }
    
            if(isset($request->user)){
                for($i=0; $i < count($show_story); $i++){
                    if($show_story[$i]['user_name'] == $request->user){
                        return view('home.story', ['all_story' => $show_story, 'show_story_number' => $i]);
                    }
                }
            }
    
            return view('home.story', ['all_story' => $show_story, 'show_story_number' => 0]);
        }else{
            return redirect()->route('signin');
        }
    }

    public function create(Request $request){

        if(auth::check()){
            $inputs = $request->only([
                'title',
                'description',
                'story_picture',
            ]);
    
            $inputs['UID'] = Auth::id();
            
            if ($request->hasFile('story_picture')) {
                $image = $request->file('story_picture');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('story-pictures'), $imageName);
                $inputs['story_picture'] = '/story-pictures/' . $imageName;
            }
    
            $story = story::create($inputs);
    
            if($story){
                notify()->success('add story successfully!');
                return redirect(route('home'));
            }
            return redirect()->back();
        }else{
            return redirect()->route('signin');
        }

    }
}

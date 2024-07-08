<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\story;

use Illuminate\Http\Request;

class StoryControllers extends Controller
{
    public function show(Request $request){
        $all_story = story::all();
        
        foreach ($all_story as $story) {
            $user = User::where('id', $story->UID)->select('id', 'user_name', 'first_name', 'last_name', 'profile_pic')->first();
            $story['user_id'] = $user['id'];
            $story['user_name'] = $user['user_name'];
            $story['first_name'] = $user['first_name'];
            $story['last_name'] = $user['last_name'];
            $story['user_profile_pic'] = $user['profile_pic'];
        }

        return view('home.story', ['all_story' => $all_story]);
    }

    public function create(Request $request){

        $inputs = $request->only([
            'title',
            'description',
            'story_picture',
        ]);

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

    }
}

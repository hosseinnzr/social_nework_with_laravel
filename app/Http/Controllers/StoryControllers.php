<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\story;

use Illuminate\Http\Request;

class StoryControllers extends Controller
{
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

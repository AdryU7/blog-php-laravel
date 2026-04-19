<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function edit(Profile $profile)
    {
        return view('subscriber.profiles.edit', compact('profile'));
    }

    public function update(ProfileRequest $request, Profile $profile)
    {
        $user = Auth::user();

        if($request->hasFile('photo')) {
            File::delete(public_path('storage/' . $profile->photo));
            // Asign new photo
            $photo = $request['photo']->store('profiles');
        } else {
            $photo = $user->profile->photo;
        }

        // Asign name and email
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        //Asign photo
        $user->profile->photo = $photo;

        // Save user
        $user->save();
        // Save profile
        $user->profile->save();

        return redirect()->route('profiles.edit', $user->profile->id);
    }
}

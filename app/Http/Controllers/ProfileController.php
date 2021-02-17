<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $date = date('Y-m-d');
        $items = Item::where('user_id', $user->id)->where('date', $date)->get();
        $currentTotal = Item::where('user_id', $user->id)->where('date', $date)->sum('expense');
        $total = Item::where('user_id', $user->id)->sum('expense');

        return view('profile', [
            'user' => $user,
            'profile' => $profile,
            'total' => $total,
            'date' => $date,
            'items' => $items,
            'currentTotal' => $currentTotal
        ]);
    }

    public function create(){
        return view('createProfile');
    }

    public function postCreate() {
        $data = request()->validate([
            'description' => 'required',
            'profilepic' => ['required', 'image'],
        ]);

        // store the image in uploads, under public
        // request(‘profilepic’) is like $_GET[‘profilepic’]
        $imagePath = request('profilepic')->store('uploads', 'public');

        // create a new profile, and save it
        $user = Auth::user();
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->description = request('description');
        $profile->image = $imagePath;
        $saved = $profile->save();

        // if it saved, we send them to the profile page
        if ($saved) {
            return redirect('/profile');
        }
        
    }

    
}

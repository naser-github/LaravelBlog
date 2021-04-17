<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show($id){
        
        $user = Profile::where('id',$id)->first();

        return view('profile.view', compact('user'));
    }

    public function edit($id){

        $profiles = Profile::where('user_id',$id)->first();
        
        return view ('profile.edit', compact('profiles'));
    }

    public function update($id, Request $request){
        
        request()->validate([
            'name' => 'required|max:255',
            'pass' => 'required|min:6',
            'phone'=> 'min:11|max:11',
            'dob' => 'date',
            'image' => 'image|mimes:jpeg,png,jpg|max:1000'
        ],[
            'pass.min' => 'password must be 6 character long',
            'phone.min' => 'phone number must be 11 character long',
            'phone.max' => 'phone number should not be more than 11 character long',
            'don.date' => 'it must be in date format',
            'image.image' => 'must be a image file',
            'image.mimes' => 'must be a jpeg,png,jpg file',
            'image.max' => 'image size exceeded'
        ]);

        if(request()->hasFile('image')){
            $destinationPath = 'uploads';

            $ext = request()->file('image')->getClientOriginalExtension();
            
            $file_name = uniqid().".".$ext;
            
            request()->file('image')->move($destinationPath, $file_name);   
        }

        $name = $request->input('name');
        $pass = $request->input('pass');
        $phone = $request->input('phone');
        $dob = $request->input('dob');
        $address = $request->input('address');
        $bio = $request->input('bio');

        $profile = Profile::where('user_id',$id)->first();
        
        $profile->image = $file_name;
        $profile->phone = $phone;
        $profile->dob = $dob;
        $profile->address = $address;
        $profile->bio = $bio;

        $profile->save();

    }
}

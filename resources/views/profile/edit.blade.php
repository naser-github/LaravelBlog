@extends('layouts.app')

@section('template_title','Travel Diary\Edit Profile')

@section('template_body')
    <br> <br>
    
    <div class="container">
        <form action="{{route('update_profile', $profiles->id)}}" method="post" enctype="multipart/form-data" class="border-dark">
        @csrf
        
            <div class="mb-3 col-10" style="margin-left:70%;">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" name="image" id="image">
            </div>
            
            <div class="mb-3 col-10">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" value="{{Auth::user()->name}}">  
            </div>

            <fieldset disabled>
            <div class="mb-3 col-10">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="{{Auth::user()->email}}">
              <div id="email" class="form-text">You can not change your email.</div>
            </div>
            </fieldset>

            <div class="mb-3 col-10">
                <label for="pass" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="pass" aria-describedby="pass" value="{{Auth::user()->password}}">  
            </div>
            
            <div class="mb-3 col-10">
                <label for="phone" class="form-label">Phone</label>
                <input type="phone" name="phone" class="form-control" id="phone" aria-describedby="phone" value="{{$profiles->phone}}">
            </div>

            <div class="mb-3 col-10">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" id="dob" aria-describedby="dob" value="{{$profiles->profile_dob}}">
            </div>

            <div class="mb-3 col-10">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address" aria-describedby="address" value="{{$profiles->profile_address}}">
            </div>

            <div class="mb-3 col-10">
                <label for="bio" class="form-label">Profile Bio</label>
                <input type="text" name="bio" class="form-control" id="bio" aria-describedby="bio" value="{{$profiles->profile_bio}}">
            </div>
        
            <button type="submit" name="submit" class="btn btn-dark">Submit</button>
        
        </form>
    </div>

    

@endsection


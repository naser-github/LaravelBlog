@extends('layouts.app')
@section('template_title','Travel Diary\Login')

@section('template_body')

    <div class=".container-xxl">
        <div class="row">
        <div class="col-md-3 ms-md-auto">
        <div class="card text-white bg-dark mb-3" style="width: 14rem; height:600px;">
            
            @if (Auth::user()->id == $profile->id)
            
            <div class="card-header">
                <a href="{{route('create_post')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi me-3" width="30%" height="80px"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">
                        <button class="btn btn-primary">New Post</button>
                    </span>
                </a>
            </div>
            
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{route('show_post')}}" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"></svg>
                    See Your Posts
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile', Auth::user()->id) }}" class="nav-link active">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                    Profile
                    </a>
                </li>
                <li>
                    <form action="{{route('delete_profile',Auth::user()->id)}}" method='POST'>
                    @csrf
                    @method('delete')

                        <button type="submit" name="submit" class="btn btn-dark" style="margin-left: 10%;">
                            Delete your Account
                        </button>
                    </form>
                </li>

            </ul>    
            
            @endif
            
            <hr>
        </div>
        </div>
        
        <div class="col-md-4 ms-md-auto">
            <br> <br> <br> <br> <br>
            <div class="card border-dark mb-3" style="width: 18rem;">
                
                <img src="{{asset ('/uploads/'.$profile->profile_image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <strong>
                            {{$profile->user->name}}
                        </strong>
                    </h5>
                    <p class="card-text">
                        
                        <h6>
                            <strong>
                                <Address>
                                    Email: {{$profile->user->email}} <br> <br>
                                    Date of Birth: {{$profile->profile_dob}} <br> <br>
                                    Phone: {{$profile->phone}} <br> <br>
                                    Address: {{$profile->profile_address}} <br> <br>
                                </Address>
                            </strong>
                        </h6>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 ms-md-auto">

            <br> <br> 
            
            @if (Auth::user()->id == $profile->id)

                <button class="btn btn-dark" style="margin-left:70%; ">
                    <a class="text-white nav-link" href="{{route('edit_profile',Auth::user()->id)}}">
                        Edit Profile
                    </a>
                </button>

            @endif
            <br> <br>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Bio</h5>
                    {{--
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    --}}
                    <p class="card-text">{{$profile->profile_bio}}</p>
                    {{--
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                    --}}
                </div>
              </div>
        </div>
        
    </div>
    




@endsection


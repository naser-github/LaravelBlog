@extends('layouts.app')
@section('template_title','Travel Diary\posts')

@section('template_body')

    <div class=".container-xxl">
        
        <div class="row">
            <div class="col-md-3 ms-md-auto">
                <div class="card text-white bg-dark mb-3" style="width: 14rem; height:600px;">
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
                            <a href="{{route('show_post')}}" class="nav-link active">
                            <svg class="bi me-2" width="16" height="16"></svg>
                            See Your Posts
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile', Auth::user()->id) }}" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Profile
                            </a>
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
            
            <div class="col-md-8 ms-md-auto">
            
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
            
            @foreach ($posts as $post)
                
            @foreach ($post->users as $user)

            @if($user->id == Auth::user()->id)
                
                <br>
                <div class="card">
                    <div class="card-body">
                            
                        <h5 class="card-title">
                            <a class="text-dark " href="{{route('open_post', $post->id)}}">
                                {{$post->post_title}}
                            </a>
                        </h5>
                            
                        <p class="card-text" style="margin-left: 85%">
                            <small class="text-muted">Posted {{$post->created_at->diffForHumans() }}</small>
                        </p>
                    </div>
                </div>
            @endif
            @endforeach
            @endforeach
            </div>
        </div>
    </div>

@endsection




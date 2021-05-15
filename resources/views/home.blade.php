@extends('layouts.app')

@section('template_title','Travel Diary')

@section('template_body')

    <div class="container py-5">

        <button class="btn btn-dark btn-lg" type="submit" name="submit" style="margin-left: 80%;">
                <a href="{{route('create_post')}}" class="text-white" >
                    Create New Post
                </a>
        </button>

        @if(Auth::user()->role_id == 3)

            <button class="btn btn-dark btn-lg" type="submit" name="submit" >
                <a href="{{route('show_users')}}" class="text-white">
                    Users List
                </a>
            </button>

        @endif

        <div class="col-md-6 offset-md-3">
            {{--search bar--}}
            <div class="card bg-dark text-white">
                <img src="{{ asset ('image/home-11.jpg') }}" class="card-img" alt="....." width="60" height="120">
                <div class="card-img-overlay">
                    <form class="form-inline my-2 my-lg-0 justify-content-center" action="{{route('search')}}" method="POST">
                    @csrf
                        
                        <label for="search" class="form-label" style="margin-left: 4%;">
                            <h3>Find what you seek &nbsp;</h3>
                        </label>
                        
                        <input class="form-control mr-sm-2" placeholder="Search by Title or Tag" type="search" aria-label="Search" name="searching" required>

                        <button class="btn btn-light search_button mt-2" type="submit" name="submit" style="margin-left: 60%;">
                            Search
                        </button>

                    </form>
                </div>
            </div>
        </div>
        <br> <hr>
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach ($posts as $post)
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                
                                @foreach ($post->users as $author)
                                    <a class="text-dark text-decoration-none " href="{{route('profile', $author->id)}}">
                                        {{$author->name}}
                                    </a>
                                @endforeach
                            </h5>
                                
                        </div>

                        <div class="card-body">

                            <a class="text-dark " href="{{route('show', $post->id)}}">
                                <strong>
                                    <h5>
                                        @if (!empty($post->thumbnail))
                                        <img src="{{asset("/posts/$post->thumbnail")}}" class="img rounded-circle" style="margin-right:15px;" alt="img" width="60"> 
                                        @endif
                                        {{$post->post_title}}
                                    </h5>
                                </strong>    
                            </a>
                            
                            <p class="card-text">
                                {{substr($post->post_body, 0, 50)}}
                                <a class="text-dark " href="{{route('show', $post->id)}}">
                                    <strong>
                                        [see more]
                                    </strong> 
                                </a>
                            </p>

                            <p class="card-text" style="margin-left: 85%">
                                <small class="text-muted">Posted {{$post->created_at->diffForHumans() }}</small>
                            </p>

                        </div>
                    </div>
                    <br>
                @endforeach
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
 
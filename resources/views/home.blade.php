@extends('layouts.app')

@section('template_title','Travel Diary')

@section('template_body')

    <br>
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

    <div class="container">
        <br> <hr>
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach ($posts as $post)
                    <div class="card">
                        <div class="card-header">
                            <a class="text-dark " href="{{route('open_post', $post->id)}}">
                                {{$post->post_title}}
                            </a>
                        </div>

                        <div class="card-body">
                            
                            <p class="card-text" style="margin-left: 85%">
                                <small class="text-muted">Posted {{$post->created_at->diffForHumans() }}</small>
                            </p>

                        </div>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
 
@extends('layouts.app')

@section('template_title','Travel Diary')

@section('template_body')

    <div class="container">
        <br> <hr>
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($result == "No Result Found")

                    <div class="card-header">
                        {{$result}}
                    </div>
                @else
                    @foreach ($result as $post)
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
                @endif
            </div>
        </div>
    </div>

@endsection

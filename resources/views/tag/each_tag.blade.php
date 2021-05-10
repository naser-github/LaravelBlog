@extends('layouts.app')

@section('template_title','Travel Diary \ New Tag')

@section('template_body')
    
    <div class="container py-5">
        
        <div class="card">
            <div class="card-header">
                {{$tag->name}}
            </div>
            <div class="card-body">
              
              <p class="card-text">{{$tag->description}}</p>
              
            </div>
          </div>
    </div>

@endsection
@extends('layouts.app')

@section('template_title','Travel Diary \ New Post')

@section('template_body')

<br> <br>

    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            {{ $error}}
        @endforeach
    </div>
    @endif
    
    <div class="container">
        <form action="{{route('store_post')}}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="mb-3 col-10" style="margin-left:60%;">
                <label for="images[]" class="form-label">Upload Images</label>
                <input type="file" name="images[]" id="images[]" multiple>
            </div>

            <div class="mb-3 col-10">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="title" required>
            </div>

            <div class="mb-3 col-10">
                <label for="post_body" class="form-label">Post</label>
                <div class="form-floating">
                    <textarea name="post_body" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required></textarea>
                </div>
            </div>

            <div class="mb-3 col-10">
                <label for="category[]" class="form-label text-md-right">Chose A Category</label>
                
                <select name="category[]" class="dropdown-item" id="category[]" multiple required>
                    @foreach($tags as $tag)
                    
                        <option value="{{ $tag->id }}">
                            <strong> {{ $tag->tag_type }} </strong>
                        </option>
                    
                    @endforeach
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-dark">Submit</button>
        
        </form>
    </div>

    
@endsection
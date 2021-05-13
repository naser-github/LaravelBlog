@extends('layouts.app')

@section('template_title','Travel Diary \ New Post')

@section('template_css')


@endsection

@section('template_body')

    <div class="container py-5">
        
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{ $error}}
            @endforeach
        </div>
        @endif

        <form action="{{route('update_post', $post->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('Patch')
{{--
            <div class="mb-3 col-10" style="margin-left:60%;">
                <label for="images[]" class="form-label">Upload Images</label>
                <input type="file" name="images[]" id="images[]" multiple>
            </div>
--}}
            <div class="mb-3 col-10">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" name="title" class="form-control @error ('title') is-invalid @enderror" id="title" aria-describedby="title" required value="{{$post->post_title}}">
            </div>

            <div class="mb-3 col-10">
                <label for="post_body" class="form-label">Post</label>
                <div class="form-floating">
                    <textarea name="post_body" class="form-control" id="floatingTextarea2" style="height: 100px" required >{{$post->post_body}}</textarea>
                </div>
            </div>

            <div class="mb-3 col-10 form-group">
                <label for="category[]" class="form-label text-md-right">Chose A Category</label>
                
                <select name="category[]"  class="dropdown-item" id="category[]" multiple required>
                    @foreach($tags as $tag)
                    
                        <option value="{{ $tag->id }}" {{$selected_tags->contains($tag->id)?'selected':''}}>
                            <strong> {{ $tag->name }} </strong>
                        </option>
                    
                    @endforeach
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-dark" style="margin-left: 75%;">Submit</button>
        
        </form>
    </div>
@endsection
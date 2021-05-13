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
            
            <div class="mb-3" style="margin-left:60%;">
                <label for="images[]" class="form-label @error ('images') is-invalid @enderror">Upload Images</label>
                <input type="file" name="images[]" id="images[]" value="{{old('images')}}" multiple>
                @error('images')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('images')}}</strong>
                    </span>
                @enderror
                
                @foreach ($post->postphotos as $photo)
                        <img src="{{asset("/posts/$photo->photo_name")}}" alt="thumbnail" width="100">
                @endforeach
            </div>

            <div class="mb-3" style="margin-left:58%;>
                <label for="thumbnail" class="form-label @error ('thumbnail') is-invalid @enderror">Upload a Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" value="{{old('thumbnail')}}">
                @error('thumbnail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('thumbnail')}}</strong>
                    </span>
                @enderror
                <img src="{{asset("/posts/$post->thumbnail")}}" alt="thumbnail" width="100">
            </div>
 
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
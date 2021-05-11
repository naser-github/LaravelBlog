@extends('layouts.app')

@section('template_title','Travel Diary \ New Post')

@section('template_body')

    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            {{ $error}}
        @endforeach
    </div>
    @endif
    
    <div class="container py-5">
        <form action="{{route('store_post')}}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="mb-3 col-10" style="margin-left:60%;">
                <label for="images[]" class="form-label @error ('images') is-invalid @enderror">Upload Images</label>
                <input type="file" name="images[]" id="images[]" value="{{old('images')}}" multiple>
                @error('images')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('images')}}</strong>
                    </span>
                @enderror
            </div>
 
            <div class="mb-3 col-10">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" name="title" value="{{old('title')}}" class="form-control @error ('title') is-invalid @enderror" id="title" aria-describedby="title" required>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$errors->first('title')}}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 col-10">
                <label for="post_body" class="form-label">Post</label>
                <div class="form-floating">
                    <textarea name="post_body" class="form-control @error ('post_body') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required>{{old('post_body')}}</textarea>
                    @error('post_body')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('post_body')}}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 col-10">
                <label for="category[]" class="form-label text-md-right">Chose A Category</label>
                
                <select name="category[]" class="dropdown-item" id="category[]" multiple required>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}" {{!empty(old('category') )?(in_array($tag->id,old('category'))? 'selected':'') : ''}}
                        
                        >
                            <strong> {{$tag->name}} </strong>
                        </option>                    
                    @endforeach
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-dark">Submit</button>
        
        </form>
    </div>  
@endsection


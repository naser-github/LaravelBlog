@extends('layouts.app')

@section('template_title','Travel Diary \ New Tag')

@section('template_body')

<br> <br>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">                   
                    <div class="card-body">
                        <form action="{{route('save_tag')}}" method="POST" enctype="multipart/form-data">
                        @csrf
    
                            <div class="Form-group">
                                <label for="name" class="form-label">Tag name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" value="{{old('name')}}" required>
    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$errors->first('name')}} </strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="Form-group">
                                <label for="description" class="form-label">Tag Description</label>
                                <div class="form-floating">
                                    <textarea name="description" class="form-control @error('description')@enderror" placeholder="Write a Description about this tag" id="floatingTextarea2" style="height: 100px">{{old('description')}}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong> {{$errors->first('description')}} </strong>\
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <br>
                            <button type="submit" name="submit" class="btn btn-dark">Submit</button>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

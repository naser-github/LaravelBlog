@extends('home.template')

@section('template_body')

    <div class="col-md-6 offset-md-3">
        {{--search bar--}}
        <div class="card bg-dark text-white">
            <img src="{{ asset ('image/home-11.jpg') }}" class="card-img" alt="....." width="60" height="120">
            <div class="card-img-overlay">
                <form class="form-inline my-2 my-lg-0 justify-content-center"
                action="#" method="POST">
                    <h3> Find what fits you &nbsp; &nbsp; </h3>
                    <input class="form-control mr-sm-2" placeholder="Search"
                    type="search" aria-label="Search" name="title">
                    <button class="btn btn-outline-white" type="submit" name="title_s">Search</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection

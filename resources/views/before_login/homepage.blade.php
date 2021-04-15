@extends('before_login.template')

@section('template_css')
    <style>
        .search_button {
            margin: 0;
            position: absolute;
            left: 80%;
            -ms-transform: translateY(-40%);
            transform: translateY(-30%);
        }
    </style>
@endsection

@section('template_body')

    <div class="col-md-6 offset-md-3">
        {{--search bar--}}
        <div class="card bg-dark text-white">
            <img src="{{ asset ('image/home-11.jpg') }}" class="card-img" alt="....." width="60" height="158">
            <div class="card-img-overlay">
                <form class="form-inline my-2 my-lg-0 justify-content-center" action="#" method="POST">
                @csrf
                    <h3> Find what you seek &nbsp; &nbsp; </h3>
                    <input class="form-control mr-sm-2" placeholder="Search" type="search" aria-label="Search" name="title">
                    <br>
                    <button class="btn btn-light search_button " type="submit" name="search">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

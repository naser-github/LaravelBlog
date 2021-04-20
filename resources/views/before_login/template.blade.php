<!DOCTYPE html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>@yield('template_title')</title>

    @yield('template_css')

    <style>
    .footer {
        position: relative;
        left: 0;
        bottom: 0%;
        width: 100%;
        background-color: #2E2E2E;
        color: white;
        text-align: center;
        }
    </style>

</head>

<body>
<div id="app">
    {{--navbar--}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="{{ asset ('image/look-1.png') }}" alt="logo" height="60" width="60"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('homepage')}}">{{__('Travel Diary')}}</a>
                    </li>
                </ul>
                
                <span class="">
                    <button type="button" class="btn btn-light btn-sm">
                        <a class="nav-link link-dark" href="{{route('login')}}">{{ __('Login') }}</a>
                    </button>     
                </span>
                &nbsp; &nbsp; &nbsp; &nbsp;
            </div>
        </div>
    </nav>

    <br> <br>

    @yield ('template_body')
    
    <div class="footer">
        <p>Footer</p>
    </div>

    @yield ('template_script')

    </div>
</body>

</html>
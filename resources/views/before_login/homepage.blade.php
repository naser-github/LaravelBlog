@extends('before_login.template')

@section('template_title','Travel Diary')

@section('template_css')

    <style>
        a:link {
            color: black;
            text-decoration: none;
        }

    </style>

@endsection

@section('template_body')

<br>
    <div class="col-md-6 offset-md-3">
        {{--search bar--}}
        <div class="card bg-dark text-white">
            <img src="{{ asset ('image/home-11.jpg') }}" class="card-img" alt="....." width="60" height="160">
            <div class="card-img-overlay">
                <form class="form-inline my-2 my-lg-0 justify-content-center" action="{{route('search')}}" method="POST">
                @csrf
                    
                    <label for="search" class="form-label" >
                        <h3>Find what you seek &nbsp;</h3>
                    </label>
                    
                    <input class="form-control mr-sm-2" placeholder="Search by Title or Tag" type="search" aria-label="Search" name="searching" required>

                    <button class="btn btn-light search_button mt-2" type="submit" name="submit" style="margin-left: 88%;">
                        Search
                    </button>

                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <br> <hr>
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach ($posts as $post)
                    <div class="card">
                        <div class="card-header">
                        @foreach ($post->users as $author)
                            {{$author->name}} 
                        @endforeach
                            
                        </div>

                        <div class="card-body">

                            <a class="text-dark " href="{{route('show', $post->id)}}">
                                <strong>
                                    <h5>
                                            
                                        {{$post->post_title}}
                                    </h5>
                                </strong>    
                            </a>
                            
                            <p class="card-text">
                                {{substr($post->post_body, 0, 50)}}
                                <a class="text-dark " href="{{route('show', $post->id)}}">
                                    <strong>
                                        [see more]
                                    </strong> 
                                </a>
                            </p>

                            <p class="card-text" style="margin-left: 85%">
                            
                                <small class="text-muted">Posted {{$post->created_at->diffForHumans() }}</small>
                            </p>

                        </div>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    </div>



<script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}
</script>

    <br> <br> <br> <br>

@endsection
 
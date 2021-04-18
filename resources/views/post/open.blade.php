@foreach ($posts as $post)
                    
<div class="col-md-8 ms-md-auto">
@foreach ($post->users as $user)

@if($user->id == Auth::user()->id)

    <br>
    <div class="card">
        <div class="card-body">
            <h6>
                <strong>
                    Tags : 
                    @foreach($post->tags as $post_tag)
                    
                    @foreach ($tags as $tag)
                            
                    @if( $post_tag->id == $tag->id)
                    
                    <button type="button" class="btn btn-dark btn-sm">
                        <a href="#" class="text-white">
                            {{$tag->tag_type}}
                        </a>
                    </button>
                    @endif

                    @endforeach
                    
                    @endforeach
                </strong>
            </h6>

            <hr>

            <h5 class="card-title">{{$post->post_title}}</h5>
            <p class="card-text">
                {{$post->post_body}}
            </p>

            @foreach ($post->postphotos as $photo)
            
            <img src="{{asset ('/posts/'.$photo->photo_name)}}" class="card-img-bottom" alt="..." style="width: 24rem;">
            
            @endforeach

            <p class="card-text" style="margin-left: 85%">
                <small class="text-muted">Posted {{$post->created_at->diffForHumans() }}</small>
            </p>
        </div>
    </div>
@endif

@endforeach
</div>

@endforeach
@extends('layouts.app')
@section('template_title','Travel Diary\ Tag List')

@section('template_body')

    <div class="container py-5">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
        @endif
        <a href="{{route('create_tag')}}" class=" text-white text-decoration-none">
            <span class="badge bg-dark" style="margin-left: 85%; font-size:24px;">
                Add New Tag
            </span>
        </a>
        <br> <br>

        <table class="table table-striped table-hover">
            <tr>
                <th style="width: 5%; font-size: 24px;">Id</th>
                <th style="width: 5%; font-size: 24px;">Name</th>
                <th style="width: 70%; font-size: 24px;" >Desc</th>
                <th style="width: 15%; font-size: 24px;">Action</th>
            </tr>
            @foreach ($tags as $tag)
            <tr>
                <td> {{$tag->id}} </td>
                <td>
                    <a class="text-dark" href="{{route('show_tag',$tag->id)}}">
                        {{$tag->name}}
                    </a>
                </td>
                <td> {{$tag->description}} </td>
                <td>
                    <form action="{{route('delete_tag',$tag->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        
                        
                        <a href="{{route('edit_tag', $tag->id)}}" style="text-decoration: none" class="text-dark btn btn-dark">
                            <span class="badge bg-warning" style="font-size: 14px;">Edit</span>
                        </a>
                        
                        <button type="submit" name="delete" class="btn btn-dark">
                            <span class="badge bg-danger" style="font-size: 14px;">Delete</span>
                        </button>
                        
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div style="margin-left: 88%;">
            {{ $tags->links() }}
        </div>
    </div>
    

@endsection




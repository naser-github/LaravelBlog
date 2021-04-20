@extends('layouts.app')

@section('template_title','Users List')

@section('template_css')
    <style>
        a:link {
        color: white;
        }
    </style>
@endsection

@section('template_body')
<br>

    
    <div class="container">

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>

                        <form action="{{route('change_role', $user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('Patch')
                            <button class="btn btn-dark btn-sm" type="submit" name="role" >
                                    Change Role to 
                                    
                                @if ( $user->role_id == '3' )
                                    Author
                                @else
                                    Admin
                                @endif

                            </button>
                        </form>
                        <br>
                        
                        <form action="{{route('ban_user', $user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('delete')
                            <button class="btn btn-dark btn-sm" type="submit" name="ban" >
                                    Ban User
                            </button>
                        </form>
                    </td>
                
                </tr>
            @endforeach
        </tbody>
        </table>
       
    </div>
@endsection
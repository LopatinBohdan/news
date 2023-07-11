@extends('layouts.app')

@section('content')
<table class="table table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Operations</th>
    </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
            <tr>
               <td>{{$user->id}}</td> 
               <td>{{$user->name}}</td>
               <td>
                <div class="d-flex">
                    <a href="{{URL::to('users/'.$user->id.'/edit')}}" class='btn btn-outline-secondary me-3'>Edit</a>
                    <form method="post" action="{{route('users.destroy',$user->id)}}">
                         @csrf
                        @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-outline-danger"/>
                </form>
                </div>
                
            </td>
               
            </tr>
        @endforeach
    </tbody>


</table>

@endsection
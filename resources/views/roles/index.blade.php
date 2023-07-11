@extends('layouts.app')

@section('content')
<a href="{{URL::to("roles/create")}}" class="btn btn-outline-primary">Create Role</a>
<table class="table table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>Operations</th>
    </tr>
    </thead>

    <tbody>
        @foreach ($roles as $role)
            <tr>
               <td>{{$role->id}}</td> 
               <td>{{$role->name}}</td> 
               <td>{{$role->created_at}}</td> 
               <td>{{$role->updated_at}}</td> 
               <td>
                <div class="d-flex">
                    <a href="{{URL::to("roles/".$role->id."/edit")}}"class="btn btn-outline-secondary me-3">Edit</a>
                    <form method="post" action="{{route('roles.destroy',$role->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-outline-danger">
                    </form> 
                </div>
            </td>
            </tr>
        @endforeach
    </tbody>


</table>

@endsection
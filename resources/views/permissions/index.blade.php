@extends('layouts.app')

@section('content')
<a href="{{URL::to("permissions/create")}}" class="btn btn-outline-primary">Create Permission</a>
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
        @foreach ($permissions as $permission)
            <tr>
               <td>{{$permission->id}}</td> 
               <td>{{$permission->name}}</td> 
               <td>{{$permission->created_at}}</td> 
               <td>{{$permission->updated_at}}</td> 
               <td>
                <div class="d-flex">
                    <a href="{{URL::to("permissions/".$permission->id."/edit")}}"class="btn btn-outline-secondary me-3">Edit</a>
                    <form method="post" action="{{route('permissions.destroy',$permission->id)}}">
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
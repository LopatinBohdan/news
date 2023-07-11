@extends('layouts.app')

@section('content')

<form action="{{route('roles.update', $role->id)}}" method="post">
    @csrf
    @method('PUT')
    <input name="name" class="form-control" value="{{$role->name}}"/>
    <div class="d-flex flex-column" >
        @for ($i = 0; $i < count($permissions); $i++)
            <label>{{$permissions[$i]->name}}
                <input type="checkbox" name="permission{{$i}}" {{$role->hasPermissionTo($permissions[$i]->name)?'checked':""}} value="{{$permissions[$i]->name}}">
            </label>
        @endfor
   </div>
    <input type="submit" class="btn btn-outline-primary" value="Edit Role">
</form>
@endsection
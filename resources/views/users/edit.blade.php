@extends('layouts.app')

@section('content')

<form method="post" action="{{route('users.update',$user->id)}}">
    @csrf
    @method('PUT')
    <input name="name" value="{{$user->name}}" required/>
    <input value="{{$user->email}}" readonly/>
   <div class="d-flex flex-column" >
        @for ($i = 0; $i < count($roles); $i++)
            <label>{{$roles[$i]->name}}
                <input type="checkbox" name="role{{$i}}" {{$user->hasRole($roles[$i]->name)?'checked':""}} value="{{$roles[$i]->name}}">
            </label>
        @endfor
   </div>
    <input type="submit" value="Update User" class="btn btn-outline-secondary"/>
</form>



@endsection
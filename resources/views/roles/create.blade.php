@extends('layouts.app')

@section('content')

<form action="{{route('roles.store')}}" method="post">
    @csrf
    <input name="name" class="form-control" required/>
    <div class="d-flex flex-column" >
        @for ($i = 0; $i < count($permissions); $i++)
            <label>{{$permissions[$i]->name}}
                <input type="checkbox" name="permission{{$i}}" value="{{$permissions[$i]->name}}">
            </label>
        @endfor
   </div>
    <input type="submit" class="btn btn-outline-primary" value="Add Role">
</form>
@endsection
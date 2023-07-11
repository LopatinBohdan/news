@extends('layouts.app')

@section('content')

<form action="{{route('permissions.update', $permission->id)}}" method="post">
    @csrf
    @method('PUT')
    <input name="name" class="form-control" value="{{$permission->name}}"/>
    <input type="submit" class="btn btn-outline-primary" value="Edit Permission">
</form>
@endsection
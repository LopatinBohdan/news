@extends('layouts.app')

@section('content')

<form action="{{route('statuses.update', $status->id)}}" method="post">
    @csrf
    @method('PUT')
    <input name="name" class="form-control" value="{{$status->name}}"/>
    <input type="submit" class="btn btn-outline-primary" value="Edit Status">
</form>
@endsection
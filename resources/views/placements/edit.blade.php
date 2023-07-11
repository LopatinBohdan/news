@extends('layouts.app')

@section('content')

<form action="{{route('placements.update', $placement->id)}}" method="post">
    @csrf
    @method('PUT')
    <input name="title" class="form-control" value="{{$placement->title}}"/>
    <input name="description" class="form-control" value="{{$placement->description}}"/>
    <input name="country" class="form-control" value="{{$placement->country}}"/>
    <input name="region" class="form-control" value="{{$placement->region}}"/>
    <input name="city" class="form-control" value="{{$placement->city}}"/>
    <input name="street" class="form-control" value="{{$placement->street}}"/>
    <input name="home" class="form-control" value="{{$placement->home}}"/>
    <input name="terms" class="form-control" value="{{$placement->terms}}"/>
    <input name="longitude" class="form-control" value="{{$placement->longitude}}"/>
    <input name="latitude" class="form-control" value="{{$placement->latitude}}"/>
    <input type="submit" class="btn btn-outline-primary" value="Edit Permission">
</form>
@endsection
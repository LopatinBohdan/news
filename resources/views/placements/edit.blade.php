@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/placements">Placements</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
  </nav>

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
    <input name="longitude" class="form-control" value="{{$placement->longitude}}"/>
    <input name="latitude" class="form-control" value="{{$placement->latitude}}"/>
    <input type="submit" class="btn btn-outline-primary" value="Edit Placement">
</form>
@endsection
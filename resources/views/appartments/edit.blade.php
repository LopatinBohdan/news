@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/placements">Placements</a></li>
      <li class="breadcrumb-item"><a href="/placements/{{$placement[0]->id}}">PlacementShow</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
  </nav>

<form action="{{route('appartments.update', $appartment->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input name="title" class="form-control" value="{{$appartment->title}}"/>
    <input type="number" name="personAmount" class="form-control" value="{{$appartment->personAmount}}"/>
    <input type="number" name="roomAmount" class="form-control" value="{{$appartment->roomAmount}}"/>
    <input type="number" name="price" class="form-control" value="{{$appartment->price}}"/>
    <input type="submit" class="btn btn-primary" value="Edit Permission">
</form>
@endsection
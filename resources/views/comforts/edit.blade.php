@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item"><a href="/comforts">Comforts</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
  </nav>

<form action="{{route('comforts.update', $comfort->id)}}" method="post">
    @csrf
    <input name="title" class="form-control" required value="{{$comfort->title}}"/>
    <select name="categoryId" class="form-select"> 
        @foreach ($categories as $category)
        <option value={{$category->id}} >{{$category->title}}</option>
        @endforeach
    </select>
    <input type="submit" class="btn btn-outline-primary" value="Add Comfort">
</form>
@endsection
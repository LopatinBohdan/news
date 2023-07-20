@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
  </nav>

<form action="{{route('categories.store')}}" method="post">
    @csrf
    <input name="title" class="form-control" required/>
    <input type="submit" class="btn btn-outline-primary" value="Add Category">
</form>
@endsection
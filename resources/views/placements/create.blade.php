@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/placements">Placements</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
  </nav>
<div class="row">
    <div class="form-group col-xs-3">
    <form action="{{route('placements.store')}}" method="post" enctype="multipart/form-data">
    
        @csrf
        <input name="title" class="form-control" required placeholder="title" maxlength="30"/>
        <input name="description" class="form-control" required placeholder="description"/>
        <input name="country" class="form-control" required placeholder="country"/>
        <input name="region" class="form-control" required placeholder="region"/>
        <input name="city" class="form-control" required placeholder="city"/>
        <input name="street" class="form-control" required placeholder="street"/>
        <input name="home" class="form-control" required placeholder="home"/>
        <input name="longitude" class="form-control" required placeholder="longitude"/>
        <input name="latitude" class="form-control" required placeholder="latitude"/>
        <input type="file" name="placement_photo[]" multiple/>
        <input type="submit" class="btn btn-outline-primary" value="Add Placement"/>
        
    
    </form>
</div>
</div>


@endsection
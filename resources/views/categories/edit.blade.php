@extends('layouts.app')

@section('content')

<form action="{{route('categories.update', $category->id)}}" method="post">
    @csrf
    @method('PUT')
    <input name="name" class="form-control" value="{{$category->title}}"/>
    <input type="submit" class="btn btn-outline-primary" value="Edit Category">
</form>
@endsection
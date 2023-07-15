@extends('layouts.app')

@section('content')

<form action="{{route('categories.store')}}" method="post">
    @csrf
    <input name="name" class="form-control" required/>
    <input type="submit" class="btn btn-outline-primary" value="Add Category">
</form>
@endsection
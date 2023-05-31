@extends('layout')
@section('content')

<form action="{{route('News.update', $temp->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input name="summary" required value='{{$temp->summary}}'><br>
    <input name="description" required value='{{$temp->description}}'><br>
    <textarea name="full_text" required >{{$temp->full_text}}</textarea><br>
    <label>Choose the file</label><input type="file" name="path">
    <input type="submit" value="Edit" class="btn btn-primary">
    <a class='btn btn-danger' href="{{URL::to('News')}}">Back</a>
</form>
@endsection
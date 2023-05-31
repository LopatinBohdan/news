@extends('layout')
@section('content')

<form action="{{route('News.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input name="summary" required placeholder="Summary"><br>
    <input name="description" required placeholder="Description"><br>
    <textarea name="full_text" required placeholder="Full_text"></textarea><br>
    <label>Choose the file</label><input type="file" name="path">
    <input type="submit" value="Add" class="btn btn-primary">
    
</form>
@endsection
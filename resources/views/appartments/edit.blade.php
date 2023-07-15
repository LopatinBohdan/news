@extends('layouts.app')

@section('content')

<form action="{{route('appartments.update', $appartment->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input name="title" class="form-control" value="{{$appartment->title}}"/>
    <input type="number" name="personAmount" class="form-control" value="{{$appartment->personAmount}}"/>
    <input type="number" name="roomAmount" class="form-control" value="{{$appartment->roomAmount}}"/>
    <input type="checkbox" name="isFree" value="{{$appartment->isFree}}" class="btn-check" id="btn-check-outlined" autocomplete="off">
    <label class="btn btn-outline-primary" for="btn-check-outlined">Is Free</label><br>
    {{-- <input type="checkbox" name="isFree" class="form-control" /> --}}
    <input type="number" name="price" class="form-control" value="{{$appartment->price}}"/>
    <input type="submit" class="btn btn-primary" value="Edit Permission">
</form>
@endsection
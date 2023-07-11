@extends('layouts.app')

@section('content')

<form action="{{route('appartments.update', $appartment->id)}}" method="post">
    @csrf
    @method('PUT')
    <input name="title" class="form-control" value="{{$appartment->title}}"/>
    <input type="number" name="personAmount" class="form-control" value="{{$appartment->personAmount}}"/>
    <input type="number" name="roomAmount" class="form-control" value="{{$appartment->roomAmount}}"/>
    {{-- <input type="checkbox" name="isFree" class="form-control" value="{{$placement->region}}"/> --}}
    <input type="number" name="price" class="form-control" value="{{$appartment->price}}"/>
    <input type="submit" class="btn btn-primary" value="Edit Permission">
</form>
@endsection
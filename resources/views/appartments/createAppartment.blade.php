@extends('layouts.app')

@section('content')


<form action="{{route('appartments.store')}}" method="post">
    @csrf
    <input name="placement_id" value={{$placement_id}} readonly/>
    <input name="title" class="form-control" required placeholder="title"/>
    <input type="number" name="personAmount" class="form-control" required placeholder="persons amount"/>
    <input type="number" name="roomAmount" class="form-control" required placeholder="rooms amount"/>
    <input name="price" class="form-control" placeholder="price"/>
    <input type="file" name="appartment_photo"/>
    <input type="submit" class="btn btn-primary" value="Add Appartment">
</form>
@endsection
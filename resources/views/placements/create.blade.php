@extends('layouts.app')

@section('content')
{{-- ----------------------------TO EDIT --}}
{{-- <a href="{{route('appartments.create', $placement->id)}}}}" class="btn btn-primary">Create Appartment</a> --}}
{{-- ---------------------------- --}}
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
        <input name="terms" class="form-control" required placeholder="terms"/>
        <input name="longitude" class="form-control" required placeholder="longitude"/>
        <input name="latitude" class="form-control" required placeholder="latitude"/>
        <input type="file" name="placement_photo"/>
        <input type="submit" class="btn btn-outline-primary" value="Add Placement"/>
        
    
    </form>
</div>
</div>


@endsection
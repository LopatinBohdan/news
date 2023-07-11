@extends('layouts.app')

@section('content')
<a href="{{URL::to("placements/create")}}" class="btn btn-outline-primary">Create Placement</a>
<table class="table table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Country</th>
        <th>Region</th>
        <th>City</th>
        <th>Street</th>
        <th>Home</th>
        <th>Terms</th>
        {{-- <th>Latitude</th>
        <th>Longitude</th> --}}
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>Operations</th>
    </tr>
    </thead>

    <tbody>
        @foreach ($placements as $placement)
            <tr>
               <td>{{$placement->id}}</td> 
               <td>{{$placement->title}}</td> 
               <td>{{$placement->description}}</td> 
               <td>{{$placement->country}}</td> 
               <td>{{$placement->region}}</td> 
               <td>{{$placement->city}}</td> 
               <td>{{$placement->street}}</td> 
               <td>{{$placement->home}}</td> 
               <td>{{$placement->terms}}</td> 
               {{-- <td>{{$placement->latitude}}</td> 
               <td>{{$placement->longitude}}</td>  --}}
               <td>{{$placement->created_at}}</td> 
               <td>{{$placement->updated_at}}</td> 
               <td>
                <div class="d-flex">
                    {{-- <a href="{{URL::to("placements/createAppartment/".$placement->id)}}" class="btn btn-outline-success me-3">Add appartment</a> --}}
                    <a href="{{URL::to("appartments/createAppartment/".$placement->id)}}" class="btn btn-outline-success me-3">Add appartment</a>
                    <a href="{{URL::to("placements/".$placement->id."/edit")}}"class="btn btn-outline-secondary me-3">Edit</a>
                    <a href="{{URL::to("placements/".$placement->id)}}"class="btn btn-outline-primary me-3">Show</a>
                    <form method="post" action="{{route('placements.destroy',$placement->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-outline-danger">
                    </form>
                </div>
                </td> 
            </tr>
        @endforeach
    </tbody>


</table>

@endsection
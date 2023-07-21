@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Placements</li>
    </ol>
  </nav>

<a href="{{URL::to("placements/create")}}" class="btn btn-outline-primary">Create Placement</a>
<table class="table table text-center">
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
               <td>{{$placement->created_at}}</td> 
               <td>{{$placement->updated_at}}</td> 
               <td>
                <div class="d-flex justify-content-center">
                    <a href="{{URL::to("appartments/createAppartment/".$placement->id)}}" class="btn btn-outline-success me-3">Add apartment</a>
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
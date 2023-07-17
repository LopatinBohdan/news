@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/placements">Placements</a></li>
    <li class="breadcrumb-item"><a href="/placements/{{$placement[0]->id}}">PlacementShow</a></li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
  </ol>
</nav>

<table class="table table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Person Amount</th>
        <th>Room Amount</th>
        <th>Is free</th>
        <th>price</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>Operations</th>
    </tr>
    </thead>
    <tbody>
            <tr>
               <td>{{$appartment->id}}</td> 
               <td>{{$appartment->title}}</td> 
               <td>{{$appartment->personAmount}}</td> 
               <td>{{$appartment->roomAmount}}</td> 
               <td>{{$appartment->isFree}}</td> 
               <td>{{$appartment->isFree}}</td> 
               <td>{{$appartment->price}}</td> 
               <td>{{$appartment->updated_at}}</td> 
               <td>
                <div class="d-flex">
                    <a href="{{URL::to("appartments/".$appartment->id."/edit")}}"class="btn btn-outline-secondary me-3">Edit</a>
                    <a href="{{URL::to("appartments/".$appartment->id)}}"class="btn btn-outline-primary me-3">Show</a>
                    <form method="post" action="{{route('appartments.destroy',$appartment->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-outline-danger">
                    </form>
                </div>
                </td> 
            </tr>
    </tbody>
</table>
        @if(isset($photo))
        <div id="carouselExampleIndicators" class="carousel slide w-50" data-bs-ride="true">
            <div class="carousel-inner">
                @for ($i = 0; $i < count($photo); $i++)
                    <div class="carousel-item {{$i==0?"active":""}}">
                    <img src="{{asset($photo[$i]->path)}}" class="d-block w-100" alt="...">
                  </div>
                @endfor
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        @endif

@endsection
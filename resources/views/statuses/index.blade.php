@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Statuses</li>
    </ol>
  </nav>

<a href="{{URL::to("statuses/create")}}" class="btn btn-outline-primary">Create Status</a>
<table class="table table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>Operations</th>
    </tr>
    </thead>

    <tbody>
        @foreach ($statuses as $status)
            <tr>
               <td>{{$status->id}}</td> 
               <td>{{$status->name}}</td> 
               <td>{{$status->created_at}}</td> 
               <td>{{$status->updated_at}}</td> 
               <td>
                <div class="d-flex">
                    <a href="{{URL::to("statuses/".$status->id."/edit")}}"class="btn btn-outline-secondary me-3">Edit</a>
                    <form method="post" action="{{route('statuses.destroy',$status->id)}}">
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
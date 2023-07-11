@extends('layouts.app')

@section('content')
<a href="{{URL::to("statuses/create")}}" class="btn btn-outline-primary">Create Status</a>
<table class="table table">-
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
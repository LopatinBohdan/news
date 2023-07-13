@extends('layouts.app')

@section('content')

<table class="table table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Person Amount</th>
        <th>Room Amount</th>
        <th>Is free</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>Operations</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($appartments as $appartment)
            <tr>
               <td>{{$appartment->id}}</td> 
               <td>{{$appartment->title}}</td> 
               <td>{{$appartment->personAmount}}</td> 
               <td>{{$appartment->roomAmount}}</td> 
               <td>{{$appartment->isFree}}</td> 
               <td>{{$appartment->created_at}}</td> 
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
        @endforeach
    </tbody>
</table>
        @if(isset($photo))
            <img class=" w-25" src="{{asset($photo[0]->path)}}"  alt="Title">
        @endif

@endsection
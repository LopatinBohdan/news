@extends('layouts.app')

@section('content')

{{-- <a href="{{URL::to("appartments/create")}}" class="btn btn-primary">Create Appartment</a> --}}
<table class="table table">
    <thead>
    <tr>
        <th>Id</th>
        <th>title</th>
        <th>personAmount</th>
        <th>roomAmount</th>
        <th>isFree</th>
        <th>price</th>
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
               <td>{{$appartment->price}}</td> 
               <td>{{$appartment->created_at}}</td> 
               <td>{{$appartment->updated_at}}</td> 
               <td>
                <div class="d-flex">
                    <a href="{{URL::to("appartments/".$appartment->id."/edit")}}"class="btn btn-secondary me-3">Edit</a>
                    <form method="post" action="{{route('appartments.destroy',$appartment->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </div>
                </td> 
            </tr>
        @endforeach
    </tbody>


</table>
@endsection
@extends('layouts.app')

@section('content')
<a href="{{URL::to("categories/create")}}" class="btn btn-outline-primary">Create Category</a>
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
        @foreach ($categories as $category)
            <tr>
               <td>{{$category->id}}</td> 
               <td>{{$category->title}}</td> 
               <td>{{$category->created_at}}</td> 
               <td>{{$category->updated_at}}</td> 
               <td>
                <div class="d-flex">
                    <a href="{{URL::to("categories/".$category->id."/edit")}}"class="btn btn-outline-secondary me-3">Edit</a>
                    <form method="post" action="{{route('categories.destroy',$category->id)}}">
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
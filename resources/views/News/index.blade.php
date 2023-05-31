@extends('layout')
@section('content')

<a href="{{route('News.create')}}" class="btn btn-success">Add News</a>

@if(count($news)>0)

        @foreach ($news as $item)
        <h2>{{$item->summary}}</h2>
        <p>{{$item->description}}</p>
        <a href="{{URL::to('News/'.$item->id)}}" class="btn btn-success">More info</a>
        <a href="{{URL::to('News/'.$item->id.'/edit')}}" class="btn btn-primary">Edit</a>
        <form action="{{route('News.destroy',$item->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="DELETE" class="btn btn-danger">
        </form>
        <hr>
        @endforeach
            
 
@endif
@endsection

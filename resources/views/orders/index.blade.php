@extends('layouts.app')

@section('content')

<table class="table table">
    <thead>
        <tr>
            <th>title</th>
            <th>totalSum</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{$order->title}}</td>
            <td>{{$order->totalSum}}</td>
        </tr>
        @endforeach

        
    </tbody>


</table>
@endsection
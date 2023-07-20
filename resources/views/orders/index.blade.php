@extends('layouts.app')
@section('content')

<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Total sum</th>
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
@extends('layouts.app')

@section('content')

<table class="table table">
    <thead>
        <tr>
            <th>title</th>
            <th>totalSum</th>
            <th>Status</th>
            <th>Operation</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{$order->title}}</td>
            <td>{{$order->totalSum}}</td>
                @foreach ($statuses as $status)
                    @if($status->id==$order->statusId)
                        <td> {{$status->name}} </td>
                    @endif
                @endforeach
            <td> 
                <form action="{{ URL::to('orders/canselfromOrders/' . $order->id) }}" method="get" >
                    <input type="submit" value="Cansel" class="btn btn-outline-danger me-3" {{$order->statusId!=1 ? 'disabled':''}}/>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
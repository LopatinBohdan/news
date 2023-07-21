@extends('layouts.app')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            @can('placement administrate')
                <li class="breadcrumb-item"><a href="/placements">Placements</a></li>
                <li class="breadcrumb-item"><a href="/placements/{{ $placement[0]->id }}">PlacementShow</a></li>
            @endcan
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>


    <div class="row">
        @if (isset($photo) && count($photo) != 0)
            <div id="carouselId" class="carousel slide col-md-4 col-12" data-bs-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    @for ($i = 0; $i < count($photo); $i++)
                        <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                            <img src="{{ asset($photo[$i]->path) }}" class="w-100 d-block" alt="First slide">
                        </div>
                    @endfor
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif
        <div class="col-md-8 col-12">
            <h2>{{ $appartment->title }}</h2>
            <ul>
                <li>Amount of people - {{ $appartment->personAmount }}</li>
                <li>Amount of rooms - {{ $appartment->roomAmount }}</li>
                <li>Price - {{ $appartment->price }} UAH</li>
                @can('Full access')
                    <li>Created - {{ $appartment->created_at }}</li>
                    <li>Updated - {{ $appartment->updated_at }}</li>
                @endcan
            </ul>
        </div>
    </div>
    @can('placement administrate')
        <table class="table table" style="text-align: center">

            <thead>
                <tr>
                    <th>BookingBegin</th>
                    <th>BookingEnd</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $item)
                    <tr>
                        <td>{{ $item->bookingFirst }}</td>
                        <td>{{ $item->bookingLast }}</td>
                        <td>
                            <div class="d-flex">
                              <a href="{{ URL::to('bookings/' . $item->id . '/edit') }}"class="btn btn-outline-secondary me-3">Edit</a>
                              <a href="{{ URL::to('orders/confirmOrder/' . $item->id) }}"class="btn btn-outline-success me-3">Confirm</a>
                              <a href="{{ URL::to('orders/canselOrder/' . $item->id) }}"class="btn btn-outline-danger me-3">Cansel</a>
                              <a href="{{ URL::to('orders/closedOrder/' . $item->id) }}"class="btn btn-outline-danger me-3">Close</a>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endcan


@endsection

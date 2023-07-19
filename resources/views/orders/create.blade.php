@extends('layouts.app')

@section('content')
<?php
    $userID = Auth::user()->id;
    // Retrieve the cookie data
    $cookieData = isset($_COOKIE[$userID]) ? $_COOKIE[$userID] : '';
    $cookieArray = json_decode($cookieData, true);
    $dataset = [];
    // Check if the cookie data exists
    if ($cookieArray) {
        // Iterate through the cookie array and perform actions
        foreach ($cookieArray as $data) {
            $dataset[] = $data;
        }
    }
?>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/orders">My orders</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <hr>
    @foreach ($dataset as $data)
        <?php $currentPlacement = $placements->where('id',$data["placementID"])->first()?>
        {{-- @dd( $currentPlacement); --}}
        <h2>Title - {{$currentPlacement->title}}</h2>
        @foreach ($data["apartmentID"] as $appartmentID)
            <?php $currentAppartment = $appartments->where('id',$appartmentID)->first()?>
            <ul>
                <li>AppTitle - {{$currentAppartment->title}}</li>
                <li>roomAmount - {{$currentAppartment->roomAmount}}</li>
                <li>peoples - {{$currentAppartment->personAmount}}</li>
                <li>price - {{$currentAppartment->price}}</li>
            </ul>
        @endforeach
    @endforeach
@endsection

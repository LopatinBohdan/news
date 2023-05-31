@extends('layout')
@section('content')

@if(isset($temp))
<h2>{{$temp->summary}}</h2>
@if($temp->path)
    <img src="{{asset($temp->path)}}" width="50%">
@endif
<p>{{$temp->full_text}}</p>
<a class='btn btn-danger' href="{{URL::to('News')}}">Back</a>
@endif
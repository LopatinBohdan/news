@extends('layout')
@section('content')

@if(isset($temp))
<h2>{{$temp->summary}}</h2>
    @if($temp->path)
        <img src="{{asset($temp->path)}}" width="50%">
    @endif
<p>{{$temp->full_text}}</p>
<a class='btn btn-danger' href="{{URL::to('News')}}">Back</a>
<hr>

<h4>Comments</h4>

@foreach($comments as $comment)
    <p>{{$comment->message}}</p>
@endforeach


@auth
    <form method="POST" action="{{route('Comment.store')}}">
        @csrf
        <textarea name="message"></textarea>
        <input type="hidden" name="news_id" value="{{$temp->id}}">
        <input type="submit" value="Add Comment">
    </form>
@endauth
@guest
    <a href="{{ route('login') }}">Register</a><span>or</span>
    <a href="{{ route('register') }}">Login</a>    
@endguest

@endif

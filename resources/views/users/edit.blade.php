@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/users">Users</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
  </nav>

<form method="post" action="{{route('users.update',$user->id)}}">
    @csrf
    @method('PUT')
    <input name="name" value="{{$user->name}}" required/>
    <input value="{{$user->email}}" readonly/>
   <div class="d-flex flex-column" >
        @for ($i = 0; $i < count($roles); $i++)
            <label>{{$roles[$i]->name}}
                <input type="checkbox" name="role{{$i}}" {{$user->hasRole($roles[$i]->name)?'checked':""}} value="{{$roles[$i]->name}}">
            </label>
        @endfor
   </div>
    <input type="submit" value="Update User" class="btn btn-outline-secondary"/>
</form>



@endsection
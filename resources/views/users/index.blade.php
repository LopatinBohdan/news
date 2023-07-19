@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
  </nav>

<table class="table table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Operations</th>
    </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
            <tr>
               <td>{{$user->id}}</td> 
               <td>{{$user->name}}</td>
               <td>
                <div class="d-flex">
                    <a href="{{URL::to('users/'.$user->id.'/edit')}}" class='btn btn-outline-secondary me-3'>Edit</a>
                    <form method="post" action="{{route('users.destroy',$user->id)}}">
                         @csrf
                        @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-outline-danger"/>
                </form>
                </div>
                
            </td>
               
            </tr>
        @endforeach
    </tbody>


</table>

@endsection
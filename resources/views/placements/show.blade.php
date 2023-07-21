@extends('layouts.app')

@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    @can('placement administrate')
            <li class="breadcrumb-item"><a href="/placements">Placements</a></li>
            @endcan
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>
    @can('placement administrate')
        <a href="{{URL::to("appartments/createAppartment/".$placement->id)}}" class="btn btn-outline-success me-3">Add apartment</a>
    <br>
    @endcan
    <div class="row">
        @if (isset($photos)&&count($photos)!=0)
        <div id="carouselId" class="carousel slide col-md-4 col-12" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
                @for ($i = 0; $i < count($photos); $i++)
                    <div class="carousel-item {{$i==0?"active":""}}">
                        <img src="{{ asset($photos[$i]->path) }}" class="w-100 d-block" alt="First slide">
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
            <h2 class="myH2">{{$placement->title}} @can('Full access') {{$placement->updated_at}} ({{$placement->created_at}}) @endcan</h2>
            <p class="information">{{$placement->description}}</p>
            <p class="others">Country - {{$placement->country}}</p>
            <p class="others">City - {{$placement->city}}</p>
            <p class="others">Region - {{$placement->region}}</p>
            <p class="others">Street - {{$placement->street}}</p>
            <p class="others">Home - {{$placement->home}}</p>
            <p class="others">Latitude/longitude - {{$placement->latitude}}/{{$placement->longitude}}</p>
            <ul class="list-group">
                {{-- <li class="list-group-item">City - {{$placement->city}}</li>
                <li class="list-group-item">Region - {{$placement->region}}</li>
                <li class="list-group-item">Street - {{$placement->street}}</li>
                <li class="list-group-item">Home - {{$placement->home}}</li>
                <li class="list-group-item">Latitude - {{$placement->latitude}}</li>
                <li class="list-group-item">Longitude - {{$placement->longitude}}</li> --}}
                {{-- @can('Full access')
                <li class="list-group-item">Created - {{$placement->created_at}}</li>
                <li class="list-group-item">Updated - {{$placement->updated_at}}</li>
                @endcan --}}
            </ul>
        </div>
    </div>
    <table class="table table" style="text-align: center">
        <thead>
            <tr>

                <th>Id</th>
                <th>Title</th>
                <th>Person Amount</th>
                <th>Room Amount</th>
                <th>Price</th>

                @can('Full access')
                <th>Created_at</th>
                <th>Updated_at</th>
                @endcan
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appartments as $appartment)
                <tr>

                    <td>{{ $appartment->id }}</td>
                    <td>{{ $appartment->title }}</td>
                    <td>{{ $appartment->personAmount }}</td>
                    <td>{{ $appartment->roomAmount }}</td>
                    <td>{{ $appartment->price }}</td>

                    @can('Full access')
                    <td>{{ $appartment->created_at }}</td>
                    <td>{{ $appartment->updated_at }}</td>
                    @endcan
                    <td>
                        <div class="d-flex justify-content-center">
                            <button id="button_{{ $loop->index }}"class="btn btn-outline-success me-3"
                                onclick="updateCookie('{{ auth()->user()->id }}', '{{ $placement->id }}', '{{ $appartment->id }}','button_{{ $loop->index }}')">To
                                order</button>
                                @can('placement administrate')
                            <a
                                href="{{ URL::to('appartments/' . $appartment->id . '/edit') }}"class="btn btn-outline-secondary me-3">Edit</a>
                                @endcan
                                <a
                                href="{{ URL::to('appartments/' . $appartment->id) }}"class="btn btn-outline-primary me-3">Show</a>
                                @can('placement administrate')
                                <form method="post" action="{{ route('appartments.destroy', $appartment->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-outline-danger">
                                @endcan
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection

@section('script')
    <script>
        var userID = {{auth()->user()->id}};
        var cookieData = getCookie(userID);
        var cookieArray = cookieData ? JSON.parse(cookieData) : [];
        for (var i = 0; i < cookieArray.length; i++) {
            if(cookieArray[i].placementID=={{$placement->id}}){
                var apartments = cookieArray[i].apartmentID;
                for (var j = 0; j < apartments.length; j++) {
                    var apartmentId = apartments[j];
                    var buttonId = "button_" + i;
                    var button = document.getElementById(buttonId);
                    if (button && button.getAttribute("onclick").includes("'" + apartmentId + "'")) {
                        button.disabled = true;
                        break;
                    }
                }
            }
        }

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function updateCookie(userID, placementID, apartmentID, buttonId) {
            // Retrieve the existing cookie data or initialize an empty array
            var cookieData = getCookie(userID);
            var cookieArray = cookieData ? JSON.parse(cookieData) : [];

            // Check if the cookie with the same placementID exists
            var cookieExists = false;
            for (var i = 0; i < cookieArray.length; i++) {
                if (cookieArray[i].placementID === placementID) {
                    // Check if the apartmentID already exists in the array
                    if (!cookieArray[i].apartmentID.includes(apartmentID)) {
                        // Add the apartmentID to the existing cookie data
                        cookieArray[i].apartmentID.push(apartmentID);
                        cookieExists = true;
                        break;
                    }
                }
            }
            // If the cookie doesn't exist, create a new row
            if (!cookieExists) {
                var newRow = {
                    placementID: placementID,
                    apartmentID: [apartmentID]
                };
                cookieArray.push(newRow);
            }
            document.getElementById(buttonId).disabled = true;

            // Update the cookie
            setCookie(userID, JSON.stringify(cookieArray), 1);

            // Optional: Display the updated cookie value
            console.log("Updated cookie: " + JSON.stringify(cookieArray));
        }
    </script>
@endsection

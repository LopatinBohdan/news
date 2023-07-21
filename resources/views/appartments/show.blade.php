@extends('layouts.app')

@section('content')

<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    @can('placement administrate')
    <li class="breadcrumb-item"><a href="/placements">Placements</a></li>
    @endcan
    <li class="breadcrumb-item"><a href="/placements/{{$placement->id}}">PlacementShow</a></li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
  </ol>
</nav>


<div class="row">
  @if (isset($photo)&&count($photo)!=0)
  <div id="carouselId" class="carousel slide col-md-4 col-12" data-bs-ride="carousel">
      <div class="carousel-inner" role="listbox">
          @for ($i = 0; $i < count($photo); $i++)
              <div class="carousel-item {{$i==0?"active":""}}">
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
    <h2 class="myH2">{{$appartment->title}} @can('Full access') {{$appartment->updated_at}} ({{$appartment->created_at}}) @endcan</h2>
            <p class="others">Amount of people - {{$appartment->personAmount}}</p>
            <p class="others">Amount of rooms - {{$appartment->roomAmount}}</p>
            <h3 class="myH2">Price - {{$appartment->price}}</h3>
     
      
        <button id="button"class="btn btn-outline-success me-3"
            onclick="updateCookie('{{ auth()->user()->id }}', '{{ $placement->id }}', '{{ $appartment->id }}','button')">To
            order</button>
  </div>

</div>

 <div class="row mb-1">
        @foreach ($comfortCategories as $category)
            <div class="col-md-3 col-12">
                <h4>{{ $category->title }}</h4>
                @foreach ($comforts as $comfort)
                    @if ($comfort->categoryId == $category->id)
                        <div>
                            <i class="fa-regular fa-circle-check fa-fade me-2"
                                style="color: #144ade;"></i>{{ $comfort->title }}
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
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
                            <div class="d-flex justify-content-center">
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

@section('script')
<script>
var userID = {{ auth()->user()->id }};
var cookieData = getCookie(userID);
var cookieArray = cookieData ? JSON.parse(cookieData) : [];
for (var i = 0; i < cookieArray.length; i++) {
    if (cookieArray[i].placementID == {{ $placement->id }}) {
        var apartments = cookieArray[i].apartmentID;
        for (var j = 0; j < apartments.length; j++) {
            if(apartments[j]=={{$appartment->id}}){
                var buttonId = "button";
                var button = document.getElementById(buttonId);
                if (button && button.getAttribute("onclick").includes("'" + apartments[j] + "'")) {
                    button.disabled = true;
                }
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

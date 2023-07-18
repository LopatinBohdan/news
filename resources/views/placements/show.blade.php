@extends('layouts.app')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/placements">Placements</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>

    <table class="table table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Person Amount</th>
                <th>Room Amount</th>
                <th>Is free</th>
                <th>Created_at</th>
                <th>Updated_at</th>
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
                    <td>{{ $appartment->isFree }}</td>
                    <td>{{ $appartment->created_at }}</td>
                    <td>{{ $appartment->updated_at }}</td>
                    <td>
                        <div class="d-flex">
                            <button id="button_{{ $loop->index }}"class="btn btn-outline-success me-3"
                                onclick="updateCookie('{{ auth()->user()->id }}', '{{ $placement->id }}', '{{ $appartment->id }}','button_{{ $loop->index }}')">To
                                order</button>
                            <a
                                href="{{ URL::to('appartments/' . $appartment->id . '/edit') }}"class="btn btn-outline-secondary me-3">Edit</a>
                            <a
                                href="{{ URL::to('appartments/' . $appartment->id) }}"class="btn btn-outline-primary me-3">Show</a>
                            <form method="post" action="{{ route('appartments.destroy', $appartment->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-outline-danger">
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (isset($photo))
        <img class="w-25" src="{{ asset($photo[0]->path) }}" alt="Title">
    @endif
@endsection

@section('script')
    <script>
        var cookieData = getCookie("my_cookie");
        var cookieArray = cookieData ? JSON.parse(cookieData) : [];
        for (var i = 0; i < cookieArray.length; i++) {
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
            var cookieData = getCookie("my_cookie");
            var cookieArray = cookieData ? JSON.parse(cookieData) : [];

            // Check if the cookie with the same userID and placementID exists
            var cookieExists = false;
            for (var i = 0; i < cookieArray.length; i++) {
                if (cookieArray[i].userID === userID && cookieArray[i].placementID === placementID) {
                    // Check if the apartmentID already exists in the array
                    if (cookieArray[i].apartmentID.includes(apartmentID)) {
                        // Disable the button
                        document.getElementById(buttonId).disabled = true;
                        return; // Exit the function
                    } else {
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
                    userID: userID,
                    placementID: placementID,
                    apartmentID: [apartmentID]
                };
                cookieArray.push(newRow);
            }

            // Update the cookie
            setCookie("my_cookie", JSON.stringify(cookieArray), 1);

            // Optional: Display the updated cookie value
            console.log("Updated cookie: " + JSON.stringify(cookieArray));
        }
    </script>
@endsection

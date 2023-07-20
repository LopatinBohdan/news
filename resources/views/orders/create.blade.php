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
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <p class="breadcrumb-item"><a href="/home">Home</a></p>
            <p class="breadcrumb-item"><a href="/orders">My orders</a></p>
            <p class="breadcrumb-item active" aria-current="page">Create</p>
        </ol>
    </nav>
    <hr>

    @foreach ($dataset as $data)
        <form action="{{route('orders.store')}}" method="post">
            @csrf
            
            <?php $currentPlacement = $placements->where('id', $data['placementID'])->first(); ?>
            <h2>Title - {{ $currentPlacement->title }}</h2>
            <input type="hidden" name="placementId" value="{{$currentPlacement->id}}"/>
            @foreach ($data['apartmentID'] as $appartmentID)
                <?php $currentAppartment = $appartments->where('id', $appartmentID)->first(); ?>

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <ul>
                                <p><b>AppTitle - {{ $currentAppartment->title }}</b></p>
                                <p><b>roomAmount - {{ $currentAppartment->roomAmount }}</b></p>
                                <p><b>peoples - {{ $currentAppartment->personAmount }}</b></p>
                                <p><b>price - {{ $currentAppartment->price }}</b></p>
                            </ul>
                        </div>
                        <div class="col">
                            <label>Check date</label><br>
                            <div name="dates" id="reportrange_{{$currentAppartment->id}}" style="background: #ffffff00; cursor: pointer; width: 50%">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <input type="date" name="firstDate_{{$currentAppartment->id}}" id="firstDate_{{$currentAppartment->id}}" readonly class="form-control" />
                                    <input type="date" name="lastDate_{{$currentAppartment->id}}" id="lastDate_{{$currentAppartment->id}}" readonly class="form-control" />
                                    <i class="fa fa-caret-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                    </div>
                </div>
            @endforeach
            <div class="col-sm-6">
                <h4>Total price</h4><br>
                <input name="totalPrice_{{$currentPlacement->id}}" type="text" id="totalPrice_{{$currentPlacement->id}}" value="0"/>
            </div>
            <div class="col-sm-4"><input type="submit" name="makeOrder" value="Make Order"
                    class="btn btn-outline-success" /></div>
        </form>
    @endforeach
@endsection
@section('script')
    <script>
       
        
        $(function() {
            @foreach ($dataset as $data)
            <?php $currentPlacement = $placements->where('id', $data['placementID'])->first();?>
            @foreach($data['apartmentID'] as $appartmentID)
            $('#reportrange_{{$appartmentID}}').on('apply.daterangepicker', function(ev, picker) {
                var totalPrice=document.getElementById('totalPrice_{{$currentPlacement->id}}');
                <?php $currentAppartment = $appartments->where('id', $appartmentID)->first(); ?>
                var price=parseFloat({{$currentAppartment->price}});
                var days= (new Date(document.getElementById('lastDate_{{$appartmentID}}').value).getTime() 
                - new Date(document.getElementById('firstDate_{{$appartmentID}}').value).getTime())/(1000 * 3600 * 24);
                if(totalPrice.value!=0 && !isNaN(days)){
                    totalPrice.value=parseFloat(totalPrice.value)-price*days;
                }
                document.getElementById('firstDate_{{$appartmentID}}').value = picker.startDate.format('YYYY-MM-DD');
                document.getElementById('lastDate_{{$appartmentID}}').value = picker.endDate.format('YYYY-MM-DD');
                days= (new Date(document.getElementById('lastDate_{{$appartmentID}}').value).getTime() 
                - new Date(document.getElementById('firstDate_{{$appartmentID}}').value).getTime())/(1000 * 3600 * 24);
                totalPrice.value=parseFloat(totalPrice.value)+price*days;
                
            });

            function cb(start, end) {
                $('#reportrange #firstDate').val(start.format('MMMM D, YYYY'));
                $('#reportrange #lastDate').val(end.format('MMMM D, YYYY'));
            }

            $('#reportrange_{{$appartmentID}}').daterangepicker({
                minDate: moment(),
                ranges: {
                    'Today': [moment(), moment()],
                    'tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
                    'Next 7 Days': [moment(), moment().add(6, 'days')],
                    'Next 30 Days': [moment(), moment().add(29, 'days')],
                    'This Month': [moment(), moment().endOf('month')],
                    'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month')
                        .endOf('month')
                    ]
                }
            }, cb);
            @endforeach
            @endforeach
            
            
        });
    </script>
@endsection

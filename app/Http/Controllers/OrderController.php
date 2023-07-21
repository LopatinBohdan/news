<?php

namespace App\Http\Controllers;

use App\Models\Appartment;
use App\Models\Order;
use App\Models\Placement;
use App\Models\Status;
use App\Models\Booking;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $orders = Order::where("userId",$userId)->get();
        $statuses=Status::all();
        return view('orders.index', compact('orders', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $placements = Placement::all();
        $appartments = Appartment::all();
        return view('orders.create', compact('placements','appartments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order=new Order();
        $order->userId=auth()->user()->id;
        $order->placementId=$request->get('placementId');
        $placement=Placement::find($order->placementId);
        // $d=(new DateTime())->format("dd-mm-YYYY");
        $d=(new DateTime());
        $order->title="Order ".$placement->title." ".$d->format("d-m-Y");
        $order->totalSum=$request->get('totalPrice_'.$placement->id);

        $order->statusId=Status::where('name', "awaiting confirmation")->first()->id;
        $order->save();

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
        $pi=$placement->id;

        $data=array_filter($dataset, function($q)use($pi){
            return OrderController::filterByIdReverse($q,$pi);
        });
       
        foreach ($data[0]['apartmentID'] as $appartmentID) {
            $booking=new Booking();
            $booking->bookingFirst=$request->get('firstDate_'.$appartmentID);
            $booking->bookingLast=$request->get('lastDate_'.$appartmentID);
            $booking->appartmentId=$appartmentID;
            $booking->orderId=$order->id;
            $booking->save();

            $order->appartments()->attach(Appartment::find($appartmentID));
        }   
       
        $cookieArray=array_filter($cookieArray, function($q)use($pi){
            return OrderController::filterById($q,$pi);
        });
        setcookie(auth()->user()->id, json_encode($cookieArray));

        return redirect("/");
    }

     function filterById($q,$pi){
        return $q['placementID']!=$pi; 
    }
    function filterByIdReverse($q,$pi){
        return $q['placementID']==$pi; 
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order=Order::find($id);
        
        return view('orders.show', compact('order', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order=Order::find($id);

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function canselOrder(string $id){
        $booking=Booking::find($id);
        $order=Order::find($booking->orderId);
        $order->statusId=3;
        $order->save();
        $appartment_id=$booking->appartmentId;
        // BookingController::destroy($id);
        $booking->delete();

        return redirect()->action(
            [AppartmentController::class, 'show'], ['appartment' => $appartment_id]
        );
    }
    public function canselfromOrders(string $id){
        // $booking=Booking::find($id);
        // $order=Order::find($booking->orderId);
        // $order->statusId=3;
        // $order->save();
        // $appartment_id=$booking->appartmentId;
        // // BookingController::destroy($id);
        // $booking->delete();
        $order=Order::find($id);
        $booking=Booking::where('orderId', $order->id)->first();
        $order->statusId=3;
        $order->save();
        $appartment_id=$booking->appartmentId;
        $booking->delete();

        return redirect()->action(
            [AppartmentController::class, 'show'], ['appartment' => $appartment_id]
        );
    }
    public function confirmOrder(string $id){
        $booking=Booking::find($id);
        $order=Order::find($booking->orderId);
        $order->statusId=2;
        $order->save();
        $appartment_id=$booking->appartmentId;

        return redirect()->action(
            [AppartmentController::class, 'show'], ['appartment' => $appartment_id]
        );
    }
    public function closedOrder(string $id){
        $booking=Booking::find($id);
        $order=Order::find($booking->orderId);
        $order->statusId=4;
        $order->save();
        $appartment_id=$booking->appartmentId;

        $booking->delete();
        return redirect()->action(
            [AppartmentController::class, 'show'], ['appartment' => $appartment_id]
        );
    }

    public function destroy(string $id)
    {
        $order = Order::find($id);
        $order->appartments()->detach();
        $order->delete();
        return redirect('orders');
    }
}

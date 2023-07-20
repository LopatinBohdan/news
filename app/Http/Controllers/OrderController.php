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
        return view('orders.index', compact('orders'));
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
        $order->title="Order ".$placement->title." ".((new DateTime())->format("dd-mm-YYYY"));
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

        return view('orders.show', compact('order'));
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
    public function destroy(string $id)
    {
        $order = Order::find($id);
        $order->appartments()->detach();
        $order->delete();
        return redirect('orders');
    }
}

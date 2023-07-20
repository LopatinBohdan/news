<?php

namespace App\Http\Controllers;

use App\Models\Appartment;
use App\Models\Order;
use App\Models\Placement;
use App\Models\Status;
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

        $order->title=$request->get('title');
        $order->userId=$request->get('userId');
        $order->appartmentId=$request->get('appartmentId');
        $order->placementId=$request->get('placementId');
        $order->totalSum=$request->get('totalSum');

        $order->statusId=Status::where('title', "awaiting confirmation")->get()->id;
        $order->save();
        redirect("/");
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

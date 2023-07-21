<?php

namespace App\Http\Controllers;

use App\Models\Appartment;
use App\Models\Booking;
use App\Models\Order;
use App\Models\Photo;
use App\Models\Placement;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AppartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $placement=Placement::find($id);
        $placement_id=$placement->id;
        return view('appartments.index', compact('placement_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appartments.create');
    }
    public function createAppartment($id)
    {
        $placement=Placement::find($id);
        $placement_id=$placement->id;
        return view('appartments.createAppartment', compact('placement','placement_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $appartment=new Appartment;
        $appartment->title=$request->get('title');
        $appartment->personAmount=$request->get('personAmount');
        $appartment->roomAmount=$request->get('roomAmount');
        $appartment->price=$request->get('price');
        
        $appartment->save();
        $placement_id= $request->get('placement_id');
        $placement=Placement::find($placement_id);
        $placement->appartments()->attach($appartment);

        if($request->hasFile('appartment_photo')){
            foreach ($request->file('appartment_photo') as $file) {
                $photo=new Photo();
                $photo->path=str_replace('public', 'storage',$file->store("public\images\\".$placement_id."\\".$appartment->id));
                $photo->name=$photo->path;
                $photo->save();
                
                $appartment->photos()->attach($photo);
        }}
        
        return redirect()->action(
            [PlacementController::class, 'show'], ['placement' => $placement_id]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appartment=Appartment::find($id);
        $placement=$appartment->placements()->get();
        $photo=$appartment->photos()->get();
        $bookings=Booking::where('appartmentId',$id)->get();
        return view('appartments.show', compact('appartment', 'photo', 'placement', 'bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $appartment=Appartment::find($id);
        $placement=$appartment->placements()->get();
        return view('appartments.edit', compact('appartment','placement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $appartment=Appartment::find($id);

        $appartment->title=$request->get('title');
        $appartment->personAmount=$request->get('personAmount');
        $appartment->roomAmount=$request->get('roomAmount');
        $appartment->price=$request->get('price');
        $appartment->updated_at=new DateTime();
        $appartment->save();

        return redirect('/appartments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appartment=Appartment::find($id);
        $placement_id=$appartment->placements()->first()->id;
        if(Order::where('placementID',$placement_id)->exists()){
            $orders = Order::where('placementID',$placement_id)->get();
            foreach ($orders as $order) {
                $appartments = $order->appartments()->get();
                if($order->appartments()->where('appartmentId',$id)->exists()){
                    return redirect()->action(
                        [PlacementController::class, 'show'], ['placement' => $placement_id]
                    );
                }
            }
        }
        $photos = $appartment->photos()->get();
        foreach ($photos as $photo) {
            if(File::exists($photo->path)){
                $directoryPath = dirname($photo->path);
                File::delete($photo->path);
                if (is_dir($directoryPath) && count(glob($directoryPath . '/*')) === 0) {
                    rmdir($directoryPath);
                }
            }
            $photo->delete();
        }
        $appartment->photos()->detach();
        $appartment->placements()->detach();
        $appartment->delete();
        return redirect()->action(
            [PlacementController::class, 'show'], ['placement' => $placement_id]
        );
    }
}

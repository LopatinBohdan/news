<?php

namespace App\Http\Controllers;

use App\Models\Appartment;
use App\Models\Photo;
use App\Models\Placement;
use DateTime;
use Illuminate\Http\Request;

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
        $appartment->isFree=true;
        $appartment->price=$request->get('price');
        
        $appartment->save();
        $placement_id= $request->get('placement_id');
        $placement=Placement::find($placement_id);
        $placement->appartments()->attach($appartment);

        if(count( $_FILES)==0){
            return redirect('appartments');
        }

        if($request->hasFile('appartment_photo')){
            $photo=new Photo();
            $image=$request->file('appartment_photo');
            $imagePath=$image->store('public/imgs');
            $photo->path=str_replace('public', 'storage', $imagePath);
            $photo->name=$imagePath;
            $request->file('appartment_photo')->move($photo->path);
        
        $photo->save();

        $appartment->photos()->attach($photo);
        }

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
        return view('appartments.show', compact('appartment'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $appartment=Appartment::find($id);
        return view('appartments.edit', compact('appartment'));
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
        $appartment->isFree=$request->get('isFree');
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
        $appartment->delete();
        //$placement_id=
        return redirect('placements' );
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Appartment;
use App\Models\Comfort;
use App\Models\Photo;
use App\Models\Placement;
use DateTime;
use Illuminate\Http\Request;

class PlacementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $placements=Placement::all();
        return view('placements.index',compact('placements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('placements.create');
    }
    public function createAppartment($id)
    {
        $placement=Placement::find($id);
        $placement_id=$placement->id;
        return view('appartments.createAppartment',compact('placement','placement_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $placement=new Placement;
       $placement->title=$request->get('title');
       $placement->description=$request->get('description');
       $placement->country=$request->get('country');
       $placement->city=$request->get('city');
       $placement->region=$request->get('region');
       $placement->street=$request->get('street');
       $placement->home=$request->get('home');
       $placement->latitude=$request->get('latitude');
       $placement->longitude=$request->get('longitude');

       $placement->save();
   
       if($request->hasFile('placement_photo')){
        foreach ($request->file('placement_photo') as $file) {
            $photo=new Photo();
            $photo->path=str_replace('public', 'storage',$file->store("public\images\\".$placement->id));
            $photo->name=$photo->path;
            $photo->save();
            $placement->photos()->attach($photo);
        }}

        return redirect('placements');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $placement=Placement::find($id);
        $appartments=$placement->appartments()->get();

        $photos=$placement->photos()->get();
        return view('placements.show', compact('placement', 'appartments', 'photos') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $placement=Placement::find($id);
        return view('placements.edit', compact('placement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $placement=Placement::find($id);
        
        $placement->title=$request->get('title');
        $placement->description=$request->get('description');
        $placement->country=$request->get('country');
        $placement->city=$request->get('city');
        $placement->region=$request->get('region');
        $placement->street=$request->get('street');
        $placement->home=$request->get('home');
        $placement->latitude=$request->get('latitude');
        $placement->longitude=$request->get('longitude');

        $placement->save();

        return redirect('/placements');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $placement=Placement::find($id);
        $placement->delete();
        return redirect('placements');
    }
}

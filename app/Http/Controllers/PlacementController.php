<?php

namespace App\Http\Controllers;

use App\Models\ComfortCategory;
use App\Models\Order;
use Illuminate\Support\Facades\File;

use App\Models\Appartment;
use App\Models\Photo;
use App\Models\Placement;
use Illuminate\Http\Request;

class PlacementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $placements = Placement::all();
        return view('placements.index', compact('placements'));
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
        $placement = Placement::find($id);
        $placement_id = $placement->id;
        return view('appartments.createAppartment', compact('placement', 'placement_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $placement = new Placement;
        $placement->title = $request->get('title');
        $placement->description = $request->get('description');
        $placement->country = $request->get('country');
        $placement->city = $request->get('city');
        $placement->region = $request->get('region');
        $placement->street = $request->get('street');
        $placement->home = $request->get('home');
        $placement->latitude = $request->get('latitude');
        $placement->longitude = $request->get('longitude');

        $placement->save();

        if ($request->hasFile('placement_photo')) {
            foreach ($request->file('placement_photo') as $file) {
                $photo = new Photo();
                $photo->path = str_replace('public', 'storage', $file->store("public\images\\" . $placement->id));
                $photo->name = $photo->path;
                $photo->save();
                $placement->photos()->attach($photo);
            }
        }

        return redirect('placements');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $placement = Placement::find($id);
        $appartments = $placement->appartments()->get();
        $comfortsArray = [];
        foreach ($appartments as $appartment) {
            foreach ($appartment->comforts()->get() as $comfort) {
                if (!in_array($comfort, $comfortsArray)) {
                    $comfortsArray[] = $comfort;
                }
            }
        }
        $comfortCategories = ComfortCategory::all();
        $photos = $placement->photos()->get();
        return view('placements.show', compact('placement', 'appartments', 'photos', 'comfortsArray','comfortCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $placement = Placement::find($id);
        return view('placements.edit', compact('placement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $placement = Placement::find($id);

        $placement->title = $request->get('title');
        $placement->description = $request->get('description');
        $placement->country = $request->get('country');
        $placement->city = $request->get('city');
        $placement->region = $request->get('region');
        $placement->street = $request->get('street');
        $placement->home = $request->get('home');
        $placement->latitude = $request->get('latitude');
        $placement->longitude = $request->get('longitude');

        $placement->save();

        return redirect('/placements');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Order::where('placementID', $id)->exists()) {
            return redirect('placements');
        }
        $placement = Placement::find($id);
        $photos = $placement->photos()->get();
        foreach ($photos as $photo) {
            if (File::exists($photo->path)) {
                $directoryPath = dirname($photo->path);
                File::delete($photo->path);
                if (is_dir($directoryPath) && count(glob($directoryPath . '/*')) === 0) {
                    rmdir($directoryPath);
                }
            }
            $photo->delete();
        }
        $placement->photos()->detach();
        $appartments = $placement->appartments()->get();
        foreach ($appartments as $appartment) {
            Appartment::destroy($appartment->id);
        }
        $placement->appartments()->detach();
        $placement->delete();
        return redirect('placements');
    }
}
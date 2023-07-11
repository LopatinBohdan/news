<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use DateTime;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses=Status::all();
        return view('statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Status::create(['name'=>$request->get('name')]);
        return redirect('statuses');
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status=Status::find($id);
        return view('statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $status=Status::find($id);
        $data=$request->validate([
            'name'=>'required',
        ]);

        $status->name=$data['name'];
        $status->updated_at=new DateTime();

        $status->save();
        return redirect('/statuses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status=Status::find($id);
        $status->delete();
        return redirect('statuses');
    }
}

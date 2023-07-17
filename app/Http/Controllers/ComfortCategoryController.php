<?php

namespace App\Http\Controllers;

use App\Models\ComfortCategory;
use DateTime;
use Illuminate\Http\Request;

class ComfortCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=ComfortCategory::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category=new ComfortCategory();
        $category->title=$request->get('title');
        $category->created_at=new DateTime();
        $category->updated_at=new DateTime();
        $category->save();
        return redirect('categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComfortCategory $comfortCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=ComfortCategory::find($id);
       
        return view("categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category=ComfortCategory::find($id);
        $data=$request->validate([
            'title'=>'required',
        ]);
        $category->title=$data['title'];
        $category->updated_at=new DateTime();
        $category->save();

        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=ComfortCategory::find($id);
        $category->delete();
        return redirect("categories");
    }
}

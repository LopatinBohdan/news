<?php

namespace App\Http\Controllers;

use App\Models\Comfort;
use App\Models\ComfortCategory;
use DateTime;
use Illuminate\Http\Request;

class ComfortController extends Controller
{
    public function index()
    {
        $comforts = Comfort::all();
        $categories=ComfortCategory::all();
        return view('comforts.index', compact('comforts','categories'));
    }

    public function create()
    {
        $categories=ComfortCategory::all();
        return view('comforts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $comfort = new Comfort();
        $comfort->title = $request->get('title');
        $comfort->categoryId = $request->get('categoryId');
        $comfort->created_at=new DateTime();
        $comfort->save();

        return redirect()->route('comforts.index');
    }

    public function show($id)
    {
        $comfort = Comfort::findOrFail($id);
        return view('comforts.show', compact('comfort'));
    }

    public function edit($id)
    {
        $comfort = Comfort::findOrFail($id);
        $categories=ComfortCategory::all();
        return view('comforts.edit', compact('comfort', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $comfort = Comfort::findOrFail($id);
        $comfort->title = $request->input('title');
        $comfort->categoryId = $request->input('categoryId');
        $comfort->updated_at=new DateTime();
        $comfort->save();

        return redirect()->route('comforts.index');
    }

    public function destroy($id)
    {
        $comfort = Comfort::findOrFail($id);
        $comfort->delete();

        return redirect()->route('comforts.index');
    }
}

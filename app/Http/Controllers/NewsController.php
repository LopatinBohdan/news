<?php

namespace App\Http\Controllers;

use App\Models\News;
use DateTime;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $news= News::all();
        return view('News.index',compact('news'));
    }

    public function show($id){
        $temp=News::find($id);
        return view('News.show',compact('temp'));
    }

    public function destroy($id){
        $temp=News::find($id);
        $temp->delete();
        return redirect('/News');
    }

    public function edit($id){
        $temp=News::find($id);
        return view('News.edit',compact('temp'));
    }

    public function create(){
        return view('News.create');
    }
    public function store(Request $request){
        $data=$request->validate([
            'summary'=>'required',
            'description'=>'required',
            'full_text'=>'required',
        ]);

        $temp=new News();
        $temp->summary=$data['summary'];
        $temp->description=$data['description'];
        $temp->full_text=$data['full_text'];

        if($request->hasFile('path')){
            $picture=$request->file('path');
            $picturePath=$picture->store('public/imgs');
            $temp->path=str_replace('public', 'storage', $picturePath);
        }

        $temp->created_at=new DateTime();
        $temp->updated_at=new DateTime();

        $temp->save();
        return redirect('/News');
    } 

   
    public function update ($id, Request $request)
    {
        $data=$request->validate([
            'summary'=>'required',
            'description'=>'required',
            'full_text'=>'required',
        ]);
        $temp=News::find($id);
       
        $temp->summary=$data['summary'];
        $temp->description=$data['description'];
        $temp->full_text=$data['full_text'];
        if($request->hasFile('path')){
            $picture=$request->file('path');
            $picturePath=$picture->store('public/imgs');
            $temp->path=str_replace('public', 'storage', $picturePath);
        }
        //$temp->path=$request->get['path'];
        $temp->updated_at=new DateTime();
        
        $temp->save();
        return redirect('/News');
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DateTime;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions=Permission::all();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role=Role::create(['name' =>$request->get('name')]);

        $countPermissions=count(Permission::all());
        $permissions=[];

        for ($i=0; $i < $countPermissions; $i++) { 
            if($request->exists("permission".$i)){
                $permissions[]=$request->get('permission'.$i);
            }
        }

        $role->syncPermissions($permissions);
        return redirect('roles');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=Role::find($id);
        $permissions=Permission::all();
        return view("roles.edit", compact("role", "permissions") );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role=Role::find($id);

        $data=$request->validate([
            'name'=>'required',
        ]);

        $role->name=$data['name'];
        $role->updated_at=new DateTime();

        $countPermissions=count(Permission::all());
        $permissions=[];

        for ($i=0; $i < $countPermissions; $i++) { 
            if($request->exists("permission".$i)){
                $permissions[]=$request->get('permission'.$i);
            }
        }

        $role->syncPermissions($permissions);

        $role->save();

        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role=Role::find($id);
        $role->delete();
        return redirect("roles");
    }
}

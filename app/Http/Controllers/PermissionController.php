<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permission.list')->with([
            'permissions' => Permission::all()
        ]);
    }

    public function create()
    {
        return view('permission.create');
    }
    public function store(Request $request)
    {

       $request->validate([
           'name' => ['required',
               'unique:permissions,name',
               'string'],
        ]);

       Permission::create([
           'name' => $request->name
       ]);
       return redirect()->route('permission.index')->with('success', 'Permission created successfully.');
    }
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('permission.edit',[
            'permission' => $permission,
        ]);

    }
    public function update($id, Request $request)
    {
          $permission = Permission::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',

        ];
         Permission::make($request->all(),$rules);


        // here we will update product
        $permission->name = $request->name;

        $permission->save();
        return redirect()->route('permission.index')->with('success', 'Permission updated successfully.');
    }
    public function destroy($id)
    {

        $permission = Permission::findOrFail($id);

        $permission->delete();

        return redirect()->route('permission.index')->with('success','Permission deleted successfully.');
    }

}

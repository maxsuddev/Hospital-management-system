<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role.list')->with([
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('role.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required',
                'unique:roles,name',
                'string'],
        ]);



        Role::create([
            'name' => $request->name
        ]);
        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('role.edit',[
            'role' => $role,
        ]);

    }
    public function update($id, Request $request)
    {
        $role = Role::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',

        ];
        Role::make($request->all(),$rules);


        // here we will update product
        $role->name = $request->name;

        $role->save();
        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }
    public function destroy($id)
    {

        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('role.index')->with('success','Role deleted successfully.');
    }
    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table("role_has_permissions")
        ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();


        return view('role.add-permission')->with([
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permissions' => ['required', 'array'],
            'roles' => ['required',],
        ]);

        $permission = Permission::findOrFail($roleId);
        $roles = Role::whereIn('id', $request->roles)->get();

        $permission->syncRoles($roles);

        return redirect()->route('permission.index')->with('success', 'Roles added to permission successfully.');
    }


}


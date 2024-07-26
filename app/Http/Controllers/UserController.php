<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('user.list')->with([
            'users' => $users,
            'roles' => $roles

        ]);
    }

    public function create()
    {

        $roles = Role::all();

        return view('user.create')->with([
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|max:20',
        'roles' => 'required',
    ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
           $roles = Role::all();
           return view('user.edit')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required',
        ]);

        $data = [
          'name' => $request->name,
          'email' => $request->email,
        ];
        if (!empty($request->password)) {
         $data += [
             'password' => Hash::make($request->password)
             ];

         $user->update($data);

         $user->syncRoles($request->roles);

        }
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}



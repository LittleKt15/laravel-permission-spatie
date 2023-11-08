<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();;
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create-edit', [
            'role' => new Role(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
        ]);

        Role::create($data);

        return to_route('admin.roles.index')->with('message', 'Role Added Successfully!');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.create-edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
        ]);

        $role->update($data);

        return to_route('admin.roles.index')->with('message', 'Role Updated Successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('message', 'Role Deleted Successfully!');
    }
}

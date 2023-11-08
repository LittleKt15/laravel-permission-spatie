<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
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
        $permissions = Permission::all();
        return view('admin.roles.create-edit', compact('role', 'permissions'));
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

    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission Existed!');
        } else {
            $role->givePermissionTo($request->permission);
            return back()->with('message', 'Permission Added!');
        }
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission Revoked!');
        } else {
            return back()->with('message', 'Permission not Exists!');
        }
    }
}

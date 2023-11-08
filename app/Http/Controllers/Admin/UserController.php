<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.role', compact('user', 'roles', 'permissions'));
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back() - with('message', 'Role Exists!');
        } else {
            $user->assignRole($request->role);
            return back()->with('message', 'Role Assigned!');
        }
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role Removed!');
        } else {
            return back()->with('message', 'Role not Exists!');
        }
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            return back() - with('message', 'Permission Exists!');
        } else {
            $user->givePermissionTo($request->permission);
            return back()->with('message', 'Permission Added!');
        }
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission Removed!');
        } else {
            return back()->with('message', 'Permission not Exists!');
        }
    }

    public function destroy(User $user)
    {
        if($user->hasRole('admin')){
            return back()->with('message', 'You cannot delete because you are Admin');
        }
        $user->delete();

        return back()->with('message', 'User Deleted?');
    }
}

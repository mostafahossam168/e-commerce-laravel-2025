<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Contracts\Permission;

class RoleRepository implements RoleInterface
{
    public function index()
    {
        return Role::where(function ($q) {
            if (request('search')) {
                $q->where('name', 'LIKE', '%' . request('search') . '%');
            }
        })->latest()->paginate(15);
    }



    public function show($id)
    {
        $role = Role::find($id);
        $permissions = config()->get('permissionsname.models');
        $rolePermissions = DB::table('role_has_permissions')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('permissions.name')
            ->all();
        return [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ];
    }



    public function create()
    {
        return config()->get('permissionsname.models');
    }


    public function store($request)
    {
        $role = Role::create(['name' => $request['name']]);
        // foreach ($request['permission'] as $item) {
        //     $role->givePermissionTo($item);
        // }
        $role->syncPermissions($request['permission']);
        return $role;
    }


    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = config()->get('permissionsname.models');
        $rolePermissions = DB::table('role_has_permissions')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('permissions.name')
            ->all();
        return [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ];
    }
    public function update($request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update(['name' => $request['name']]);
        $role->syncPermissions($request['permission']);
        return $role;
    }
    public function destroy($id)
    {
        return DB::table("roles")->where('id', $id)->delete();
    }
}

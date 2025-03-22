<?php

namespace App\Repositories;

use App\Interfaces\AdminInterface;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminRepository implements AdminInterface
{


    public function index()
    {
        return User::admins()->where(function ($q) {
            if (request('search')) {
                $q->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('email', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('phone', 'LIKE', '%' . request('search') . '%');
            }
        })->latest()->paginate(15);
    }



    public function show($id)
    {
        return User::findOrFail($id);
    }



    public function create()
    {
        return Role::all();
    }



    public function store($request)
    {
        $user = User::create($request['data']);
        if ($request['image']) {
            $user->image()->create(['path' => $request['image']]);
        }
        if ($request['role']) {
            $user->assignRole($request['role']);
        }
        return $user;
    }
    public function edit($id)
    {
        // $item = User::findOrFail($id);
        // $roles =  Role::all();
        // return [
        //     'item' => $item,
        //     'roles' => $roles
        // ];
        return User::findOrFail($id);
    }


    public function update($request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request['data']);
        if ($request['image']) {
            delete_file($user->image->path);
            $user->image()->delete();
            $user->image()->create(['path' => $request['image']]);
        }

        if ($request['role']) {
            $user->syncRoles($request['role']);
        }
        return $user;
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->image) {
            delete_file($user->image->path);
        }
        return $user->delete();
    }
}
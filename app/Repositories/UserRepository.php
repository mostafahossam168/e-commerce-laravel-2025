<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function index()
    {
        return User::users()->where(function ($q) {
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

    public function create() {}
    public function store($request)
    {
        $user = User::create($request['data']);
        if ($request['image']) {
            $user->image()->create(['path' => $request['image']]);
        }
        return $user;
    }
    public function edit($id)
    {
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

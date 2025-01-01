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
    public function show($id) {}
    public function create() {}
    public function store($request) {}
    public function edit($id) {}
    public function update($request, $id) {}
    public function destroy($id) {}
}

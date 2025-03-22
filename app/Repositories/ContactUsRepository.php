<?php

namespace App\Repositories;

use App\Interfaces\ContactUsInterface;
use App\Models\ContactUs;

class ContactUsRepository implements ContactUsInterface
{
    public function index()
    {
        return ContactUs::where(function ($q) {
            if (request('search')) {
                $q->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('email', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('phone', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('message', 'LIKE', '%' . request('search') . '%');
            }
        })->latest()->paginate(15);
    }
    public function create($request)
    {
        return  ContactUs::create($request);
    }
    public function destroy($id)
    {
        $contact =  ContactUs::findOrFail($id);
        return $contact->delete();
    }
}

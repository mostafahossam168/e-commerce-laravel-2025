<?php

namespace App\Repositories;

use App\Interfaces\ContactUsInterface;
use App\Models\ContactUs;

class contactUsRepository implements ContactUsInterface
{
    public function create($request)
    {
        return  ContactUs::create($request);
    }
}

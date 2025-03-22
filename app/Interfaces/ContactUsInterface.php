<?php

namespace App\Interfaces;

interface ContactUsInterface
{
    public function index();
    public function create($request);
    public function destroy($id);
}

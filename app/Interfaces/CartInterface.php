<?php

namespace App\Interfaces;

interface CartInterface
{
    public function index();
    public function addToCart($request, $id);
    public function removeFromCart($id);
}

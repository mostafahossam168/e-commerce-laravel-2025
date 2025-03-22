<?php

namespace App\Interfaces;

interface RateInterface
{
    public function index($product_id);
    public function addRate($request, $product_id);
    public function removeRate($product_id);
}

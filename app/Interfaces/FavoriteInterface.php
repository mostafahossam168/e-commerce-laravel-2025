<?php

namespace App\Interfaces;

interface FavoriteInterface
{
    public function index();
    public function addToFavorite($id);
    public function removeFromFavorite($id);
}

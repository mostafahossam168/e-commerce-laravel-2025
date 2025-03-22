<?php

namespace App\Interfaces;

interface SettingsInterface
{
    public function show();
    public function update($request, $files);
}

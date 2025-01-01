<?php

use Illuminate\Support\Facades\Storage;

// ================================= File System =======================
function store_file($file, $path)
{
    $name = time() . $file->getClientOriginalName();
    return $value = $file->storeAs($path, $name, 'uploads');
}

function delete_file($file)
{
    if ($file != '' and !is_null($file) and Storage::disk('uploads')->exists($file)) {
        unlink('uploads/' . $file);
    }
}

function display_file($name)
{
    return asset('uploads') . '/' . $name;
}

// ================================= Arabic Time =======================
function arabic_time($time)
{
    if (!$time) {
        return '';
    }
    return str_replace(['AM', 'PM'], ["ص", "م"], \Carbon\Carbon::parse($time)->format('g:i A'));
}

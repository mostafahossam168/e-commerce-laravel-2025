<?php

namespace App\Repositories;

use App\Interfaces\SettingsInterface;
use anlutro\LaravelSettings\Facades\Setting;

class SettingsRepository implements SettingsInterface
{

    public function show()
    {
        return Setting::all();
    }
    public function update($request, $files)
    {
        $data = $request;

        $current = ['logo', 'fav'];

        foreach ($files as $file => $value) {
            if (!empty(setting($file))) {
                delete_file(setting($file));
            }
            $data[$file] = store_file($value, 'settings');
        }

        if (empty($files)) {
            foreach ($current as $ele) {
                $data[$ele] = setting($ele);
            }
        }

        \DB::table('settings')->delete();
        return   setting($data)->save();
    }
}
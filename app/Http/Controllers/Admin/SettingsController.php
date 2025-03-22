<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Interfaces\SettingsInterface;

class SettingsController extends \Illuminate\Routing\Controller
{
    private SettingsInterface $itemRepository;
    public function __construct(SettingsInterface $item)
    {
        $this->itemRepository = $item;

        $this->middleware('permission:read_settings|update_settings', ['only' => ['show']]);
        $this->middleware('permission:update_settings', ['only' => ['update']]);
    }



    public function show()
    {
        $item = $this->itemRepository->show();
        return view('admin.settings', ['item' => $item]);
    }
    public function update(SettingRequest $request)
    {
        $files = $request->only('logo', 'fav');
        // dd($files);
        $this->itemRepository->update($request->except('logo', 'fav'), $files);
        return redirect()->back()->with('sucess', 'تم تحديث الاعدادات بنجاح');
    }
}
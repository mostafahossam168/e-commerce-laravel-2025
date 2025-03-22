<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\SettingsInterface;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    private SettingsInterface $itemRepository;
    public function __construct(SettingsInterface $item)
    {
        $this->itemRepository = $item;
    }


    public function show()
    {
        $item = $this->itemRepository->show();
        return $this->returnData($item);
    }
}

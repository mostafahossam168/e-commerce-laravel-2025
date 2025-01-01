<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Interfaces\ContactUsInterface;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    private ContactUsInterface $itemRepository;
    public function __construct(ContactUsInterface $item)
    {
        $this->itemRepository = $item;
    }

    public function create(ContactUsRequest $request)
    {
        $this->itemRepository->create($request->all());
        return $this->returnSuccessMessage('تم  الارسال  بنجاح');
    }
}

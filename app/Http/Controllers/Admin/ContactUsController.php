<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ContactUsInterface;
use Illuminate\Http\Request;

class ContactUsController extends \Illuminate\Routing\Controller
{
    private ContactUsInterface $itemRepository;
    public function __construct(ContactUsInterface $item)
    {
        $this->itemRepository = $item;

        $this->middleware('permission:read_contact-us', ['only' => ['index']]);
        $this->middleware('permission:delete_settings', ['only' => ['destroy']]);
    }

    public function index()
    {
        $items = $this->itemRepository->index();
        return view('admin.contact-us.index', compact('items'));
    }

    public function destroy(string $id)
    {
        $this->itemRepository->destroy($id);
        return back()->with('success', 'تم حذف الرسالة بنجاح ');
    }
}
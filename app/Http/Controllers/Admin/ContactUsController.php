<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ContactUsInterface;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    private ContactUsInterface $itemRepository;
    public function __construct(ContactUsInterface $item)
    {
        $this->itemRepository = $item;
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

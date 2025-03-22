<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;

class UserController extends \Illuminate\Routing\Controller
{
    private UserInterface $itemRepository;
    public function __construct(UserInterface $item)
    {
        $this->itemRepository = $item;

        $this->middleware('permission:read_users|create_users|update_users|delete_users', ['only' => ['index', 'store']]);
        $this->middleware('permission:create_users', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_users', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_users', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemRepository->index();
        return view('admin.users.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->except('password', 'image', 'password_confirmation');
        $data['password'] = bcrypt($request->password);
        $data['status'] = $request->status ?? 1;
        $data['type'] = 'user';
        if ($request->image) {
            $image = store_file($request->image, 'users');
        }
        $this->itemRepository->store(['data' => $data, 'image' => $image ?? '']);
        return redirect()->route('admin.users.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item =  $this->itemRepository->edit($id);
        return view('admin.users.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->except('password', 'image');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->image) {
            $image = store_file($request->image, 'users');
        }
        $this->itemRepository->update(['data' => $data, 'image' => $image ?? ''], $id);
        return redirect()->route('admin.users.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->itemRepository->destroy($id);
        return back()->with('success', 'تم حذف العمىل بنجاح');
    }
}
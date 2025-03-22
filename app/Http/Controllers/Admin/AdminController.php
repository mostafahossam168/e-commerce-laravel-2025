<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Interfaces\AdminInterface;
use Illuminate\Http\Request;

class AdminController extends  \Illuminate\Routing\Controller
{
    private AdminInterface $itemRepository;


    public function __construct(AdminInterface $item)
    {
        $this->itemRepository = $item;

        $this->middleware('permission:read_admins|create_admins|update_admins|delete_admins', ['only' => ['index', 'store']]);
        $this->middleware('permission:create_admins', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_admins', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_admins', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemRepository->index();
        return view('admin.admins.index', compact('items'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->itemRepository->create();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->except('password', 'image', 'password_confirmation', 'role');
        $data['status'] = $request->status ?? 1;
        $data['password'] = bcrypt($request->password);
        $data['type'] = 'admin';
        if ($request->image) {
            $image = store_file($request->image, 'users');
        }
        $this->itemRepository->store(['data' => $data, 'image' => $image ?? '', 'role' => $request->role]);
        return redirect()->route('admin.admins.index')->with('success', 'تم الحفظ بنجاح');
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
        return view('admin.admins.edit', compact('item'));
    }

    public function update(AdminRequest $request, string $id)
    {


        $data = $request->except('password', 'image', 'role');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->image) {
            $image = store_file($request->image, 'users');
        }
        $this->itemRepository->update(['data' => $data, 'image' => $image ?? '', 'role' => $request->role], $id);
        return redirect()->route('admin.admins.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->itemRepository->destroy($id);
        return back()->with('success', 'تم حذف المشرف بنجاح');
    }
}
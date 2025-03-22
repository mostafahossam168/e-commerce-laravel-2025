<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Interfaces\RoleInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends \Illuminate\Routing\Controller
{

    private RoleInterface $itemRepository;
    public function __construct(RoleInterface $item)
    {
        $this->itemRepository = $item;

        $this->middleware('permission:read_roles|create_roles|update_roles|delete_roles', ['only' => ['index', 'store']]);
        $this->middleware('permission:create_roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_roles', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_roles', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemRepository->index();
        return view('admin.roles.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->itemRepository->create();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->itemRepository->store($request);
        return redirect()->route('admin.roles.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = $this->itemRepository->show($id)['role'];
        $permissions = $this->itemRepository->show($id)['permissions'];
        $rolePermissions = $this->itemRepository->show($id)['rolePermissions'];
        return view('admin.roles.show', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->itemRepository->edit($id)['role'];
        $permissions = $this->itemRepository->edit($id)['permissions'];
        $rolePermissions = $this->itemRepository->edit($id)['rolePermissions'];
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $this->itemRepository->update($request, $id);
        return redirect()->route('admin.roles.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->itemRepository->destroy($id);
        return back()->with('success', 'تم حذف الصلاحية بنجاح ');
    }
}
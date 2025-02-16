<?php

namespace App\Interfaces;

interface OrderInterface
{
    public function index();
    public function index_user($user_id);
    public function show($id);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);

    public function confirm($id);
    public function canceled($id, $request);
    public function complete($id);
}

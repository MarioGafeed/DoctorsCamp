<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface FaqInterface
{
    public function index($dataTable);

    public function create();

    public function store(array $data);

    public function edit($id);

    public function update(array $data, $id);

    public function show($id);

    public function destroy($request);

    public function multi_delete($request);
}

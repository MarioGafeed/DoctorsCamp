<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface CommentInterface
{
    public function index($dataTable);

    public function create();

    public function store(array $data);

    public function show($id);

    public function destroy($request);

    public function multi_delete($request);

    public function toggle($id);
}

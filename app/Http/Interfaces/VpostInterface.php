<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;


interface vpostInterface
{
    public function index($dataTable);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request, $id);
    public function show($id);
    public function destroy($request);
    public function multi_delete($request);
}

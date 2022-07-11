<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface EloquentRepositoryInterface
{
    public function all();
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
    public function show($id);
}

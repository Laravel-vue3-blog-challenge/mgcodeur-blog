<?php

namespace App\Interfaces;

interface EloquentRepositoryInterface
{
    public function all();
    public function create();
    public function update();
    public function delete();
    public function find();
}

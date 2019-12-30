<?php

namespace App\Repository;

use App\Contract\FooRepositoryInterface;
use App\User;

class FooRepository implements FooRepositoryInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        //
    }

    public function find(int $id)
    {
        //
    }

    public function findBy(array $condition, array $ordered = [])
    {
        //
    }

    public function findOneBy(array $condition, array $ordered = [])
    {
        //
    }

    public function create(array $data)
    {
        //
    }

    public function update(int $id, array $data)
    {
        //
    }

    public function delete(int $id)
    {
        //
    }
}
<?php

namespace App\Contract;

interface FooRepositoryInterface
{
    public function findAll();
    public function find(int $id);
    public function findBy(array $condition, array $ordered = []);
    public function findOneBy(array $condition, array $ordered = []);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
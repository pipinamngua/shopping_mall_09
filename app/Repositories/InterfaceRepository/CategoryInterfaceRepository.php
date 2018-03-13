<?php
namespace App\Repositories\InterfaceRepository;

interface CategoryInterfaceRepository
{
    public function all();

    public function find($id);
}

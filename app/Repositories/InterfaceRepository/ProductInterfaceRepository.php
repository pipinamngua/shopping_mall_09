<?php
namespace App\Repositories\InterfaceRepository;

interface ProductInterfaceRepository
{
    public function getAllProduct();

    public function store(array $input);

    public function update(array $input, $id);

    public function destroy($id);
}

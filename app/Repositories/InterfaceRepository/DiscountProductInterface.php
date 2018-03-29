<?php
namespace App\Repositories\InterfaceRepository;

interface DiscountProductInterface
{
    public function all();

    public function getAllProduct();
    
    public function getAllDiscountProgram();

    public function store(array $input);

    public function update(array $input, $id);

    public function destroy($id);
}

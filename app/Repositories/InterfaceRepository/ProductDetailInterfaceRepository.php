<?php

namespace App\Repositories\InterfaceRepository;

interface ProductDetailInterfaceRepository
{
    public function store(array $input);

    public function show($id);

    public function getColorImages($id, $colorId);

    public function update(array $input, $id);

    public function delete($id, $colorId);
}

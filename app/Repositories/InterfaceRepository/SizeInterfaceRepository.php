<?php
namespace App\Repositories\InterfaceRepository;

interface SizeInterfaceRepository
{
    public function all();

    public function find($id);

    public function store(array $input);

    public function update(array $input, $id);

    public function destroy($id);
}

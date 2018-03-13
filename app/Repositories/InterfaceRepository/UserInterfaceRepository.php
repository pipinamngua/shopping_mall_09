<?php
namespace App\Repositories\InterfaceRepository;

interface UserInterfaceRepository
{
    public function all();

    public function search($key);

    public function find($id);

    public function paginate();

    public function update(array $input, $id);

    public function delete($id);

    public function register(array $input);
}

<?php
namespace App\Repositories\EloquentRepository;

use App\Repositories\InterfaceRepository\SizeInterfaceRepository;
use Illuminate\Support\Facades\DB;
use App\Model\Size;

class SizeRepository implements SizeInterfaceRepository
{
    public function all()
    {
        $sizes = Size::orderBy('id', 'desc')->paginate(5);
        $response = [
            'pagination' => [
                'total' => $sizes->total(),
                'per_page' => $sizes->perPage(),
                'current_page' => $sizes->currentPage(),
                'last_page' => $sizes->lastPage(),
                'from' => $sizes->firstItem(),
                'to' => $sizes->lastItem(),
            ],
            'data' => $sizes,
        ];

        return $response;
    }

    public function find($id)
    {
        return Category::find($id);
    }

    public function store(array $input)
    {
        $size = new Size();
        $size->size_name = $input['size_name'];
        $size->save();

        return $size;
    }

    public function update(array $input, $id)
    {
        $size = Size::findOrFail($id);
        $size->update([
            'size_name' => $input['size_name'],
        ]);
        
        return $size;
    }

    public function destroy($id)
    {
        return Size::destroy($id);
    }
}

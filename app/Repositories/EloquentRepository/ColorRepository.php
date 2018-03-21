<?php
namespace App\Repositories\EloquentRepository;

use App\Repositories\InterfaceRepository\ColorInterfaceRepository;
use Illuminate\Support\Facades\DB;
use App\Model\Color;

class ColorRepository implements ColorInterfaceRepository
{
    public function all()
    {
        $colors = Color::orderBy('id', 'desc')->paginate(5);
        $response = [
            'pagination' => [
                'total' => $colors->total(),
                'per_page' => $colors->perPage(),
                'current_page' => $colors->currentPage(),
                'last_page' => $colors->lastPage(),
                'from' => $colors->firstItem(),
                'to' => $colors->lastItem(),
            ],
            'data' => $colors,
        ];

        return $response;
    }

    public function find($id)
    {
        return Category::find($id);
    }

    public function store(array $input)
    {
        $color = new Color();
        $color->color_name = $input['color_name'];
        $color->save();

        return $color;
    }

    public function update(array $input, $id)
    {
        $color = Color::findOrFail($id);
        $color->update([
            'color_name' => $input['color_name'],
        ]);
        
        return $color;
    }

    public function destroy($id)
    {
        return Color::destroy($id);
    }
}

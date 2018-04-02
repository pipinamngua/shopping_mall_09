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
        $check = Color::where(['color_name' => $input['color_name']])->get();
        if (!count($check)) {
            $color = new Color();
            $color->color_name = $input['color_name'];
            $color->save();

            return response()->json(['color' => $color]);
        } else {
            return response()->json(['fail' => 'the color is already exists']);
        }
        
    }

    public function update(array $input, $id)
    {
        $color = Color::find($id);
        $check = Color::where(['color_name' => $input['color_name']])->get();
        if (count($check)) {
            return response()->json(['fail' => 'can not update, the name is already exists']);
        } else {
            $color->update([
            'color_name' => $input['color_name'],
            ]);
            
            return response()->json(['color' => $color]);
        }
    }

    public function destroy($id)
    {
        return Color::destroy($id);
    }
}

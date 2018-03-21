<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Color;
use App\Repositories\InterfaceRepository\ColorInterfaceRepository;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $colorRepository;

    public function __construct(ColorInterfaceRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }


    public function index()
    {
        $response = $this->colorRepository->all();

        return response()->json($response);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only('color_name');
        $color = $this->colorRepository->store($input);

        return $color;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->only('color_name');
        $colorUpdate = $this->colorRepository->update($input, $id);
        
        return $colorUpdate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->colorRepository->destroy($id);
        
        return response()->json(['message' => 'deleted successfully']);
    }

    public function showVueColor()
    {
        return view('admin.colors.colors');
    }
}

<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Size;
use App\Repositories\InterfaceRepository\SizeInterfaceRepository;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $sizeRepository;

    public function __construct(SizeInterfaceRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    public function index()
    {
        $response = $this->sizeRepository->all();

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
        $input = $request->only('size_name');
        $size = $this->sizeRepository->store($input);

        return $size;
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
        $input = $request->only('size_name');
        $sizeUpdate = $this->sizeRepository->update($input, $id);
        
        return $sizeUpdate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->sizeRepository->destroy($id);
        
        return response()->json(['message' => 'deleted successfully']);
    }

    public function showVueSize()
    {
        return view('admin.sizes.sizes');
    }

    public function getAllSizes()
    {
        return Size::orderBy('id', 'desc')->get();
    }
}

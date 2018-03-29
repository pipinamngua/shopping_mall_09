<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscountPrograms;
use App\Repositories\InterfaceRepository\DiscountProgramInterface;


class DiscountProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $discountProgramRepository;

    public function __construct(DiscountProgramInterface $discountProgramRepository)
    {
        $this->discountProgramRepository = $discountProgramRepository;
    }


    public function index()
    {
        return $this->discountProgramRepository->all();
    }

    public function showVueDiscountProgram()
    {
        return view('admin.discountPrograms.discountProgram');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscountPrograms $request)
    {
        $input = $request->only('startedAt', 'content', 'endedAt', 'status');

        return $this->discountProgramRepository->store($input);
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
        $input = $request->only('content', 'startedAt', 'endedAt', 'status');

        return $this->discountProgramRepository->update($input, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return $this->discountProgramRepository->destroy($id);
    }
}

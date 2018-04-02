<?php
namespace App\Repositories\EloquentRepository;

use App\Repositories\InterfaceRepository\DiscountProgramInterface;
use Illuminate\Support\Facades\DB;
use App\Model\DiscountProgram;

class DiscountProgramRepository implements DiscountProgramInterface
{
    public function all()
    {
        $allDiscountProgram = DiscountProgram::orderBy('id', 'desc')->get();

        return $allDiscountProgram;
    }

    public function find($id)
    {
    }

    public function store(array $input)
    {
        $check = DiscountProgram::where(['discount_content' => $input['content']])->get();
        if (count($check)) {
            return response()->json(['fail' => 'the event is already exists']);
        } else {
            if ($input['endedAt'] < $input['startedAt']) {
                return response()->json(['fail' => 'ended_at dont be lower then started_at']);
            } else {
                $discountProgram = new DiscountProgram();
                $discountProgram->discount_content = $input['content'];
                $discountProgram->started_at = $input['startedAt'];
                $discountProgram->ended_at = $input['endedAt'];
                $discountProgram->status = $input['status'];
                $discountProgram->save();

                return response()->json(['discountProgram' => $discountProgram]);
            }
        }
    }

    public function update(array $input, $id)
    {
        $updateDiscount = DiscountProgram::find($id);
        $check = DiscountProgram::where([
            'discount_content' => $input['content'],
            'status' => $input['status'],
        ])->get();
        if (count($check)) {
            return response()->json(['fail' => 'can not update, the event is already exists']);
        } else {
            $updateDiscount->discount_content = $input['content'];
            $updateDiscount->started_at = $input['startedAt'];
            $updateDiscount->ended_at = $input['endedAt'];
            $updateDiscount->status = $input['status'];
            $updateDiscount->save();

            return response()->json(['updateDiscount' => $updateDiscount]);
        }
    }

    public function destroy($id)
    {
        $delete = DiscountProgram::destroy($id);
        return response()->json(['delete' => $delete]);
    }
}

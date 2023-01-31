<?php

namespace App\Http\Controllers\API;   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Resources\Lab as LabResource;
use App\Http\Resources\Medicine as MedicineResource;
use App\Models\Medicineorder;


class MedicineorderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $orders = Medicineorder::where('user_id',$id)->get();
        return $this->sendResponse(MedicineResource::collection($orders), 'Details fetched.');
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $input = $request->all();
            $validator = Validator::make($input, [
                'due_date' => 'required',
                'payment_mode' => 'required',
                'course_duration' => 'required',
                'have_prescription' => 'required',
                'address' => 'required',
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());       
            }
//            dd($request);
            $id = auth()->user()->id;
            $input['user_id'] = $id;
            $input['order_status'] = 'Pending';
            $fileName = time() . '_' . $request->file('prescription')->getClientOriginalName();
            $filePath = str_replace('\\', '/', public_path("assets/medicineorderuploads/prescription/"));
            $request->file('prescription')->move($filePath, $fileName);
            $input['prescription'] =  $fileName;
            $medicine = Medicineorder::create($input);
            return $this->sendResponse(new MedicineResource($medicine), 'Medicine Order Added Successfully.');            
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Medicineorder::find($id);
        if (is_null($order)) {
            return $this->sendError('Order does not exist.');
        }
        return $this->sendResponse(new MedicineResource($order), 'Medicine Order Added Successfully.');

    }

   
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancel(Medicineorder $medicineorder)
    {
        $medicineorder->order_status = 'Cancelled';
        $medicineorder->save();

        return response()->json([
            'meassage' => 'Order has been cancelled succesfully!',
            'data' => $medicineorder
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;
use App\Http\Resources\Appointment as AppointmentResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Validator;


class AppointmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        // $request->hasFile('prescription');
        $input = $request->all();
        $validator = Validator::make($input, [
            'slot_id' => 'required',
            'doctor_id' => 'required',
            'prescription' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $id = auth()->user()->id;
        $input['user_id'] = $id;
        $input['appointment_status'] = 'Pending';
        $fileName = time() . '_' . $request->file('prescription')->getClientOriginalName();
        $filePath = str_replace('\\', '/', public_path("assets/patient/appointment/prescription"));
        $request->file('prescription')->move($filePath, $fileName);
        // $data['attachments']->name = time().'_'.$request->file->getClientOriginalName();
        $input['prescription'] =  $fileName;
       
        
         //return $input;
        Appointment::create($input);
        return $this->sendResponse(new AppointmentResource( Appointment::create($input)), 'Appointment Booked Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}

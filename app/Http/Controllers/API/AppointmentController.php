<?php

namespace App\Http\Controllers\API;
use App\Http\Resources\Appointment as AppointmentResource;
use App\Http\Resources\Consultation as AppointmentConsultation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\Doctor;


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

        if($request->hasFile('prescription')){
        $fileName = time() . '_' . $request->file('prescription')->getClientOriginalName();
        $filePath = str_replace('\\', '/', public_path("assets/patient/appointment/prescription"));
        $request->file('prescription')->move($filePath, $fileName);
        // $data['attachments']->name = time().'_'.$request->file->getClientOriginalName();
        $input['prescription'] =  $fileName;
       
        }
         //return $input;
        Appointment::create($input);
        return $this->sendResponse(new AppointmentResource( Appointment::create($input)), 'Appointment Booked Successfully.');

    }


    public function appointmentConsultation()
    {
        $id = auth()->user()->id;
        $appointment = Appointment::select(
            'appointments.user_id',
            'doctors.id as doctorID',
            'doctors.name as doctorName',
            'doctors.image as doctorImage',
            'slots.date as slotDate',
            'slots.weekday as slotWeekday',
            'slots.start_time as slotTime',
            'prescriptions.id as prescriptionID',
            'prescriptions.chief_complaints',
            'prescriptions.allergies',
            'prescriptions.diagnosis',
            'prescriptions.general_advice',
            'prescriptions.chief_complaints',
            'appointments.prescription',
        )   
        // )->leftjoin('doctors','doctors.id','=','appointments.doctor_id')
     
        ->leftjoin('slots','slots.id','=','appointments.slot_id')
        ->leftjoin('prescriptions','prescriptions.patient_id','=','appointments.user_id')
        ->leftjoin('doctors','doctors.id','=','prescriptions.doctor_user_id')
        // ->leftjoin('prescriptionmedicines','prescriptionmedicines.prescription_id','=','prescriptions.id')
    //    ->groupBy('doctorID','doctorName','doctorImage','slotDate','slotWeekday','slotTime')
     
        ->where('appointments.user_id',$id)
        ->get();

     
    //  return $appointment;
        foreach($appointment as $appoint)
        {
            //  dd($appoint->prescriptionID);
            $appoint['medicines'] = $this->allPrescriptionMedicine($appoint->prescriptionID);
           
        }

        //  return  $appointment;
       return $this->sendResponse(AppointmentConsultation::collection($appointment), 'Appointment Consultation List.');
       
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


    public function allPrescriptionMedicine($id)
    {
            $prescription_medicine = Prescription::select(
                'prescriptions.id as prescriptionID ',
                'prescriptionmedicines.id as medicineID',

                'prescriptionmedicines.prescription_medicine_name',
                'prescriptionmedicines.prescription_medicine_dosage',
                'prescriptionmedicines.prescription_medicine_duration',
                'prescriptionmedicines.prescription_medicine_instructions',
                'prescriptionmedicines.prescription_medicine_freq',


            )->leftjoin('prescriptionmedicines','prescriptionmedicines.prescription_id','=','prescriptions.id')
            ->where('prescriptions.id','=',$id)
            // ->distinct()->pluck('medicineID')
            // ->toArray();
                ->get();
            return  $prescription_medicine ;
    }
}

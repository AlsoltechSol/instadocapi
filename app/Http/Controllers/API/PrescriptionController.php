<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Prescription;
use App\Models\Prescriptionmedicines;
use PDF;


class PrescriptionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     
        $input = $request->all();
        $validator = Validator::make($input, [
            'chief_complaints' => 'required',
            'allergies' => 'required',
            'diagnosis' => 'required',
            'general_advice' => 'required',
             'patient_id' => 'required',
             'prescribed_medicine' => 'required',
        ]);


        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $doctor_id = auth()->user()->id;
        $input['doctor_user_id'] = $doctor_id;

        $prescribed_medicine =  $request->prescribed_medicine;
        $decode = json_decode($prescribed_medicine, true);
       // dd($decode);
        //exit();
        unset($input["prescribed_medicine"]);
        $prescription = Prescription::create($input);

       
       
        if ($decode) {
            foreach ($decode as $index=>$prescriptions) {
                $prescribed_medicines = new Prescriptionmedicines();
                $prescribed_medicines->prescription_medicine_name = $prescriptions['prescription_medicine_name'];
                $prescribed_medicines->prescription_medicine_dosage = $prescriptions['prescription_medicine_dosage'];
                $prescribed_medicines->prescription_medicine_freq = $prescriptions['prescription_medicine_frequency'];
                $prescribed_medicines->prescription_medicine_duration = $prescriptions['prescription_medicine_duration'];
                $prescribed_medicines->prescription_medicine_instructions = $prescriptions['prescription_medicine_instructions'];
                $prescribed_medicines->prescription_id = $prescription->id;

                 $prescribed_medicines->save();

               // dd($prescriptions);
            }

        // return $prescription;
        return $this->sendResponse($prescription, 'Prescription added sucessfully');

         }
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

    public function prescriptionPdf($id)
    {

        $pres_pdf = Prescription::select(
            'prescriptions.*',
            'prescriptionmedicines.*',
            'users.mobile'
     
        )->join('prescriptionmedicines','prescriptionmedicines.prescription_id','=','prescriptions.id')
        ->join('users','users.id','=','prescriptions.doctor_user_id')
        ->where('prescriptions.id','=',$id)
        ->get();

       // dd($pres_pdf);


        $pdf = PDF::loadView('prescription_pdf',compact('pres_pdf'));

        $filename = 'prescription' . '-' . time() . '.pdf';

        $path = str_replace('\\', '/', public_path("assets/prescription/pdf/" . $filename));

         return $pdf->download('pdf_file.pdf');
       //  return $pdf;

      $pdf->save($path);

       return response()->json([
           'message' => 'Pdf generated',
           'path' => $filename
       ]);

    }
}

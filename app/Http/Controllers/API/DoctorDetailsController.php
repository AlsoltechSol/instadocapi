<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Doctor as DoctorResource;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Doctor;
use App\Models\User;
use App\Models\DoctorCity;
use App\Models\DoctorHospital;
use App\Models\DoctorSpecialization;


class DoctorDetailsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = auth()->user()->id;
        $attachments = Doctor::where('user_id',$id)->get();
        return $this->sendResponse(DoctorResource::collection($attachments), 'Doctors Lists.');
        
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

        // return($request);

//         name  -> name
//         phone -> from user table
//         email -> from user table
// --      designation -> designation
//         language -> language
// --      city -> city_id
// --      hospital -> hospital_id
//         year of experience ->yearsOfExperience
// --      doctor specialization -> specialization_id
//         doctor education -> education
//         doctor fees -> fees
//         doctor registration no -> doctor_registration_no
// --      treatment_type  -> treatment_type


        $input = $request->all(); 
        
       //dd( $input);
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'language' => 'required',
            'yearsOfExperience' => 'required',
            'education' => 'required',
            'fees' => 'required',
            'doctor_registration_no' => 'required',
            'treatment_type' => 'required'
        ]);

        unset($input["email"]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $id = auth()->user()->id;
        $input['user_id'] = $id;
        $user = auth()->user();
        $user['email'] = $request->email;
        $user->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = now()->timestamp . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/patient/attachments/'), $filename);
            $input['image'] = $filename;
         }

        $doctor = Doctor::create($input);
         $cities = explode(',',$request->city);
         $hospitals = explode(',',$request->hospital);
         $specializations = explode(',',$request->specialization);


        //  dd($hospitals);
        if($doctor)
        {
            foreach($cities as $city){
            $cityObj = new DoctorCity();
            $cityObj->doctor_id = $doctor->id;
            $cityObj->city_id = $city;
            $cityObj->save();
            }

            foreach($hospitals as $hospital){
                $hospitalObj = new DoctorHospital();
                $hospitalObj->doctor_id = $doctor->id;
                $hospitalObj->hospital_id = $hospital;
                $hospitalObj->save();
                }

                foreach($specializations as $specialization){
                    $specialObj = new DoctorSpecialization();
                    $specialObj->doctor_id = $doctor->id;
                    $specialObj->specialization_id = $specialization;
                    $specialObj->save();
                    }

        }
    
        return $this->sendResponse(new DoctorResource($doctor), 'Doctor Details Added Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $email = auth()->user()->email;
        $mobile = auth()->user()->mobile;
        $image = auth()->user()->image;

        $doctor = Doctor::where('user_id',$id)->first();
        $doctor['email'] = $email;
        $doctor['mobile'] = $mobile;
        $doctor['image'] = $image;
        return $doctor;
        // return $doctor->User();
        if (is_null($doctor)) {
            return $this->sendError('Doctor does not exist.');
        }
        return $this->sendResponse(new DoctorResource($doctor), 'Doctor Details fetched.');
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

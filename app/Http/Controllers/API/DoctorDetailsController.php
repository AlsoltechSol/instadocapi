<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Doctor as DoctorResource;
use App\Http\Resources\Appointment as AppointmentResource;
use App\Http\Resources\FilterDoctor as FilterDoctorResource;


use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Doctor;
use App\Models\User;
use App\Models\DoctorCity;
use App\Models\DoctorHospital;
use App\Models\DoctorSpecialization;
use App\Models\DoctorSymptom;

use App\Models\Appointment;
use Carbon\Carbon;

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

    public function doctorList()
    {
        $doctor = Doctor::all();
        if (is_null($doctor)) {
            return $this->sendError('doctor details does not exist.');
        }
        return $this->sendResponse(DoctorResource::collection($doctor), 'doctor Lists.');
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
            'treatment_type' => 'required',
            'image' => 'required',

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
         $symptoms = explode(',',$request->symptoms);



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

                    foreach($symptoms as $symptom){
                        $symptomObj = new DoctorSymptom();
                        $symptomObj->doctor_id = $doctor->id;
                        $symptomObj->symptom_id = $symptom;
                        $symptomObj->save();
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


        $doctor = Doctor::where('user_id',$id)->latest()->first();
        // dd($doctor);
        // $doctor['email'] = $email;
        // $doctor['mobile'] = $mobile;
        // $doctor['image'] = $image;


       // return $doctor;


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


    public function appointmentList()
    {
        $todayDate = Carbon::today();

        
        $appointment_upcoming = Appointment::select(
            'appointments.*',
            'doctors.name',
            'slots.date',
            'slots.start_time',
            'slots.end_time',
            'slots.weekday',

        )
        ->join('doctors','doctors.id','=','appointments.doctor_id')
        ->join('slots','slots.id','=','appointments.slot_id')
        ->orderBy('id', 'DESC')
        ->get();
        return $this->sendResponse(AppointmentResource::collection($appointment_upcoming), 'Upcoming Doctors Appointment Lists.');


    }

    public function filterBy(Request $request)
    {
      //  dd($request);

        $cityID = $request->cityID;
        $hospitalID = $request->hospitalID;
        $specializationID = $request->specializationID;
        $symptomID = $request->symptomID;

        $where = [];
        $cityID =  $request->cityID;
        if ($cityID) $where[] = ['doctor_cities.city_id', '=',$cityID ];

        $hospitalID = $request->hospitalID;

        if ($hospitalID) $where[] = ['doctor_hospitals.hospital_id', '=',$hospitalID ];

        $specializationID = $request->specializationID;
        if ($specializationID) $where[] = ['doctor_specializations.specialization_id', '=',$specializationID ];

        $symptomID = $request->symptomID;
        if ($symptomID) $where[] = ['doctor_symptoms.symptom_id', '=',$symptomID ];
        //dd($where);
        $filter = Doctor::select(
            'doctors.id',
            'doctors.name',          
            //'doctor_cities.doctor_id as doctorID' ,
            'doctor_cities.city_id as cityID', 
            'doctor_hospitals.hospital_id as hospitalID', 
            'doctor_specializations.specialization_id as specializationID',
            'doctor_symptoms.symptom_id as symptomID',       


        )
        ->join('doctor_cities','doctor_cities.doctor_id','=','doctors.id')
        ->join('doctor_hospitals','doctor_hospitals.doctor_id','=','doctors.id')
        ->join('doctor_specializations','doctor_specializations.doctor_id','=','doctors.id')
        ->join('doctor_symptoms','doctor_symptoms.doctor_id','=','doctors.id')

        ->where($where)
        ->get();


       
       // $users = User::where($where)->get();

       // dd($filter);
        return $this->sendResponse(FilterDoctorResource::collection($filter), 'Lists.');

    }


}

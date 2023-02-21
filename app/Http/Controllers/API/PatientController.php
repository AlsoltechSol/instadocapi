<?php

namespace App\Http\Controllers\API;   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Resources\Patient as PatientResource;
use App\Models\Patient;





class PatientController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return $this->sendResponse(PatientResource::collection($patients), 'Details fetched.');
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
            'name' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'contact_no' => 'required',
            'email_id' => 'required',
            'address' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $id = auth()->user()->id;
        $input['user_id'] = $id;

        
        if ($request->hasFile('profile_photo')){
            $fileName = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
            $filePath = str_replace('\\', '/', public_path("assets/patient-request/profile_photo/"));
            $request->file('profile_photo')->move($filePath, $fileName);
            $input['profile_photo'] = $fileName;
        }

        $patient = Patient::create($input);

        return $this->sendResponse(new PatientResource($patient), 'Patient Details Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        if (is_null($patient)) {
            return $this->sendError('Patient does not exist.');
        }
        return $this->sendResponse(new PatientResource($patient), 'Patient Details fetched.');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {

        
        $input = $request->all();

        // return $input;

        $validator = Validator::make($input, [
            'name' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'contact_no' => 'required',
            'email_id' => 'required',
            'address' => 'required'
        ]);


        // return $input['name'];

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $patient->name = $input['name'];
        $patient->gender = $input['gender'];
        $patient->dateOfBirth = $input['dateOfBirth'];
        $patient->contact_no = $input['contact_no'];
        $patient->email_id = $input['email_id'];
        $patient->address = $input['address'];
        $patient->save();

        return $this->sendResponse(new PatientResource($patient), 'Patient Details updated.');

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

<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Specialization;
use App\Models\Hospital;
use App\Models\Symptom;


use Illuminate\Support\Facades\Auth;
use App\Http\Resources\City as CityResource;
use App\Http\Resources\Specialization as SpecializationResource;
use App\Http\Resources\Hospital as HospitalResource;
use App\Http\Resources\Symptom as SymptomResource;



use Validator;


class CityController extends BaseController
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
            'name' => 'required',
            
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        // $id = auth()->user()->id;
        
        $city = City::create($input);
        return $this->sendResponse(new CityResource($city), 'City Details Added Successfully.');
    }


    public function specializationStore(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        // $id = auth()->user()->id;
        
        $specialization = Specialization::create($input);
        return $this->sendResponse(new SpecializationResource($specialization), 'Specialization has been Added Successfully.');
    }


    public function hospitalStore(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        // $id = auth()->user()->id;
        
        $hospital = Hospital::create($input);
        return $this->sendResponse(new HospitalResource($hospital), 'Hospital Details has been Added Successfully.');
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


    public function hospitalList()
    {
        $hospital = Hospital::all();
        if (is_null($hospital)) {
            return $this->sendError('Hospital details does not exist.');
        }
        return $this->sendResponse(HospitalResource::collection($hospital), 'hospital Lists.');

        // return $this->sendResponse(new HospitalResource($hospital), 'Hospital details fetched.');

    }

    public function cityList()
    {
        $city = City::all();
        if (is_null($city)) {
            return $this->sendError('City details does not exist.');
        }
        return $this->sendResponse(CityResource::collection($city), 'City Lists.');

        // return $this->sendResponse(new HospitalResource($hospital), 'Hospital details fetched.');

    }

    public function specializationList()
    {
        $specialization = Specialization::all();
        if (is_null($specialization)) {
            return $this->sendError('specialization details does not exist.');
        }
        return $this->sendResponse(SpecializationResource::collection($specialization), 'specialization Lists.');

        // return $this->sendResponse(new HospitalResource($hospital), 'Hospital details fetched.');

    }

    public function symptomsList()
    {
        $symptoms = Symptom::all();
        if (is_null($symptoms)) {
            return $this->sendError('Symptoms details does not exist.');
        }
        return $this->sendResponse(SymptomResource::collection($symptoms), 'Symptoms Lists.');

        // return $this->sendResponse(new HospitalResource($hospital), 'Hospital details fetched.');

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

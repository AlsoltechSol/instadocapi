<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Specialization;
use App\Models\Hospital;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\City as CityResource;
use App\Http\Resources\Specialization as SpecializationResource;
use App\Http\Resources\Hospital as HospitalResource;


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

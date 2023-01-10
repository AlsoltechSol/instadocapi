<?php

namespace App\Http\Controllers\API;   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Resources\Lab as LabResource;
use App\Http\Resources\Patient as PatientResource;

use App\Models\Labtest;

class LabController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $labtests = Labtest::where('user_id',$id)->get();
        return $this->sendResponse(LabResource::collection($labtests), 'Details fetched.');
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
        // $request->hasFile('prescription');
        $input = $request->all();
        $validator = Validator::make($input, [
            'test_name' => 'required',
            'payment_mode' => 'required',
            'date_of_test' => 'required',
            'prescription_exists_flag' => 'required',
            'prescription' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $id = auth()->user()->id;
        $input['user_id'] = $id;
        $fileName = time() . '_' . $request->file('prescription')->getClientOriginalName();
        $filePath = str_replace('\\', '/', public_path("assets/labtestsuploads/prescription/"));
        $request->file('prescription')->move($filePath, $fileName);
        // $data['attachments']->name = time().'_'.$request->file->getClientOriginalName();
        $input['prescription'] =  $fileName;
        $lab = Labtest::create($input);
        return $this->sendResponse(new LabResource($lab), 'Lab Details Added Successfully.');
        
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

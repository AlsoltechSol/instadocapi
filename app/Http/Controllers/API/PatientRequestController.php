<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PatientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientRequestController extends Controller
{
    public function index(){
        $requests = PatientRequest::where('user_id', Auth::user()->id)->get();

        if ($requests->count() > 0){
            return response()->json([
                'status' => 200,
                'data' => $requests
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'no data to show'
            ]);
        }
    }

    public function store(Request $request, $type){
        $request->validate([

        ]);

        $data = $request->all();

        $data['request_for'] = $type;

        $data['patient_id'] = 36;
        $data['user_id'] = Auth::user()->id;

        if ($request->hasFile('age_proof')){
            $fileName = time() . '_' . $request->file('age_proof')->getClientOriginalName();
            $filePath = str_replace('\\', '/', public_path("assets/patient-request/$type/age_prrof/"));
            $request->file('age_proof')->move($filePath, $fileName);
    
            $data['age_proof'] = $fileName;
        }

        
        if ($request->hasFile('address_proof')){
            $fileName = time() . '_' . $request->file('address_proof')->getClientOriginalName();
            $filePath = str_replace('\\', '/', public_path("assets/patient-request/$type/address_proof/"));
            $request->file('address_proof')->move($filePath, $fileName);
    
            $data['address_proof'] = $fileName;
        }

        
        if ($request->hasFile('applicant_image')){
            $fileName = time() . '_' . $request->file('applicant_image')->getClientOriginalName();
            $filePath = str_replace('\\', '/', public_path("assets/patient-request/$type/applicant_image/"));
            $request->file('applicant_image')->move($filePath, $fileName);
    
            $data['applicant_image'] = $fileName;
        }

        if ($request->hasFile('passport_image')){
            $fileName = time() . '_' . $request->file('passport_image')->getClientOriginalName();
            $filePath = str_replace('\\', '/', public_path("assets/patient-request/$type/passport_image/"));
            $request->file('passport_image')->move($filePath, $fileName);
    
            $data['passport_image'] = $fileName;
        }

        PatientRequest::create($data);

        return response()->json([
            'message' => "Request for $type added successfully",
            'data' => $data
        ]);
    }
}

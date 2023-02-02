<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserFeedback;
use App\Http\Resources\Feedback as FeedbackResource;
use Validator;

class UserFeedBackController extends BaseController
{
    public function index(){

    }

    public function store(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'rating' => 'required',
            'doctor_user_id' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $id = auth()->user()->id;
        $input['patient_user_id'] = $id;
        $feedback = UserFeedback::create($input);
        return $this->sendResponse(new FeedbackResource($feedback), 'Feedback Added Successfully.');
        
    }
}

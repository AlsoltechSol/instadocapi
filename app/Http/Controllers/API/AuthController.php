<?php
   
namespace App\Http\Controllers\API;   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Models\otp;

   
class AuthController extends BaseController
{

    public function signin(Request $request)
    {
        if(Auth::attempt(['mobile' => $request->mobile, 'otp' => $request->otp])){ 
            $authUser = Auth::user(); 
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken; 
            $success['name'] =  $authUser->name;
            return $this->sendResponse($success, 'User signed in');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'mobile' => 'required',
            'otp' => 'required' 
        ]);
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
        $user_exists = User::where('mobile',$request['mobile'])->first();
        // dd($user_exists);

        if(!isset($user_exists))
        {
            $input = $request->all();
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $user->name;
            if($user->role == "patient"){
            $success['patient_details'] = $user->Patient;
            }else{
            $success['doctor_details'] = $user->Doctor;
            }
            return $this->sendResponse($success, 'User created successfully.');
        }
        else{
            $otp_exists = otp::where('mobile',$request['mobile'])->first();
            if(!$otp_exists){
                $success['msg'] =  "Request for OTP";
                return $this->sendResponse($success, 'Login failed');
            }
            $authUser = User::where('mobile',$request['mobile'])->first();
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken; 
            $success['name'] =  $authUser->name;
            $success['role'] =  $authUser->role;
            if($authUser->role == "patient"){
             $success['patient_details'] = $authUser->Patient;
            }else{
            $success['doctor_details'] = $authUser->Doctor;
            }

            return $this->sendResponse($success, 'User signed in');

        }


    }

    public function sendotp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'role' =>   'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
   
        $input = $request->all();
        $input['otp'] = 1000;  // replace this with SMS gateway
        // return $input;
        $user = otp::create($input);
        $success['otp'] =  $user->otp;
        $success['mobile'] =  $user->mobile;
        $success['role'] =  $user->role;

   
        return $this->sendResponse($success, 'OTP sent successfully.');

    }

    public function test()
    {
        $success['msg'] =  "Hi";
        return $this->sendResponse($success, 'Success');

    }
}
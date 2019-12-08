<?php

namespace App\Http\Controllers\APIs\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Employee;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // if (isset($request->validator) && $request->validator->fails())
        // {
        //     return $this->APIResponse(null , $request->validator->messages() ,  400);
        // }

        $credentials = request(['email', 'pin_code']);

        if(!Auth::guard('employee')->attempt(['email' => request('email'), 'pin_code' => request('pin_code')])){
            return response()->json([
                'status_code' => 401,
                'success' => false,
                'message' => 'Unauthorized',
                'data'  => null
            ]);
        }
        $employee = Employee::where("email", request('email'))->first();
        $token =  $employee->createToken('token')->accessToken;
        return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Login Successfully',
                'data'  => $token
            ]);
    }

	public function logout(Request $request)
    {
        $isClinicOwner = $request->user()->token()->revoke();
        if($isClinicOwner){
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        }
        else{
            $error = "Something went wrong.";
            return $this->sendResponse($error);
        }
    }
}

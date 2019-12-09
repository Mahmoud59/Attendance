<?php

namespace App\Http\Controllers\APIs\Employee;

use App\Http\Requests\Employee\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Employee;

class AuthController extends Controller
{

    public function login(AuthRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails())
        {
            return response()->json([
                'status_code' => 400,
                'success' => false,
                'message' => $request->validator->errors()->all(),
                'data'  => null
            ]);
        }

        $credentials = request(['email', 'pin_code']);
        $employee = Employee::where("email", request('email'))->where('pin_code', request('pin_code'))->first();
        if(!$employee){
            return response()->json([
                'status_code' => 401,
                'success' => false,
                'message' => 'Unauthorized',
                'data'  => null
            ]);
        }

        $token =  $employee->createToken('token')->accessToken;
        return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Login Successfully',
                'data'  => $token
            ]);
    }

	public function logout()
    {
        $isEmployee = Auth::guard('employee-api')->user()->token()->revoke();
        if($isEmployee){
            return response()->json([
                'status_code' => 200,
                'success' => true,
                'message' => 'Successfully logged out',
                'data'  => null
            ]);
        }
        else
        {
            return response()->json([
                'status_code' => 400,
                'success' => false,
                'message' => 'Logout Failed',
                'data'  => null
            ]);
        }
    }
}

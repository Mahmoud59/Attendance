<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class AuthController extends Controller
{

	public function loginForm()
	{
		return view('admin.login');
	}

    public function login(Request $request)
    {
        // if (isset($request->validator) && $request->validator->fails())
        // {
        //     return $this->APIResponse(null , $request->validator->messages() ,  400);
        // }

        $credentials = request(['email', 'password']);

        if(!Auth::guard('user')->attempt($credentials, false, false))
        {
            return 'ww';
        }
        else
        {
        	$user = User::where('email', $request->email)->first();
        	session( ['id' => $user->id] );                
            session( ['name' => $user->name] );
            session( ['login' => 1] );       
        	return redirect('admin/employees');
        }
        
    }

    public function logout(Request $request)
    {
        session()->forget(['login']);
        return redirect('admin/login');
    }
}

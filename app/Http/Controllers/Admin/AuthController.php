<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class AuthController extends Controller
{

	public function loginForm()
	{
		return view('admin.login');
	}

    public function login(AuthRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails())
        {
            return redirect('admin/login');
        }

        $credentials = request(['email', 'password']);

        if(!Auth::guard('user')->attempt($credentials, false, false))
        {
            return redirect('admin/login');
        }
        else
        {   // session for admin 
        	$user = User::where('email', $request->email)->first();
        	session( ['id' => $user->id] );                
            session( ['name' => $user->name] );
            session( ['login' => 1] );       
        	return redirect('admin/employees');
        }
        
    }

    public function logout()
    {
        session()->forget(['login']);
        return redirect('admin/login');
    }
}

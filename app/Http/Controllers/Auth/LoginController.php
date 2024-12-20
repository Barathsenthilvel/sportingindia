<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        try{

        $request->validate([
            'emailormobile' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $user = null;
        if (filter_var($request->emailormobile, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->emailormobile)->first();
        } else {
            $user = User::where('mobile', $request->emailormobile)->first();
        }

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect('/dashboard');
        }

        throw ValidationException::withMessages([
            'email_or_mobile' => ['The provided credentials are incorrect.'],
        ]);
    }
    catch(Exception $error)
    {
        echo "error mess : ".$error->getMessage();
        die('ddddddd');
    }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


}

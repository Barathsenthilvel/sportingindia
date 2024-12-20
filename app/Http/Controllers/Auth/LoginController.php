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
        // if (filter_var($request->emailormobile, FILTER_VALIDATE_EMAIL)) {
        //     $user = User::where('email', $request->emailormobile)->first();
        // }

        if (filter_var($request->emailormobile, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->emailormobile)->first();
        } else {
            $user = User::where('mobile', $request->emailormobile)->first();
        }

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            if ($user->is_approved == 0 &&  $user->role_id == '2') {
                return redirect()->back()->with('error', 'User Not Approved by admin');
            }
            if($user->role_id == '1')
            {
                return redirect('/dashboard');

            }
            else{
                return redirect('/profile');
            }

        }
      else{
        return redirect()->back()->with('error', throw ValidationException::withMessages([
            'email_or_mobile' => ['The provided credentials are incorrect.'],
        ]));
      }

    }
    catch(Exception $error)
    {
        return redirect()->back()->with('error', $error->getMessage());
    }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


}

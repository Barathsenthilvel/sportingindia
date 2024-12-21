<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Notification;
use App\Mail\WelcomeEmail;  
use App\Jobs\SendWelcomeEmailJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\RegisterUserNotification;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userRole  = Role::where('name', 'user')->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
            'mobile' => 'required|string|size:10|unique:users,mobile',
            'email' => 'required|email|max:50|unique:users,email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('user_photos', 'public');
        }

        $user = User::create([
            'role_id' => $userRole->id,
            'name' => $request->name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'photo' => $photoPath,
            'password' => Hash::make($request->password),
            'is_approved' => false,
            'approved_at' => null,
        ]);

           // Dispatch the job
    // SendWelcomeEmailJob::dispatch($user);

    // $user = User::find(8); 
    // dd($user);
    // Replace 1 with a valid user ID
// SendWelcomeEmailJob::dispatch($user);


$admins =User::where('role_id',1)->get();

Notification::send($admins, new RegisterUserNotification($user));

$user->notify(new RegisterUserNotification($user));


    // Mail::to($user->email)->send(new RegistrationSuccessMail($user));
    

        return redirect()->back()->with('success', 'User registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

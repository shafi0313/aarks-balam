<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.auth.login');
    }

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'min:4', 'max:80'],
            'user_name' => ['required', 'string', 'min:4', 'max:80'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (filter_var($request->user_name, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->user_name)->first()){
                return response()->json(['message' => 'This email address already used'], 500);
            }
            $data['email'] = $request->user_name;
            $data['phone'] = mt_rand(1, 10000000);
        } else {
            if(User::where('phone', $request->user_name)->first()){
                return response()->json(['message' => 'This phone number already used'], 500);
            }
            $data['phone'] = $request->user_name;
            $data['email'] = mt_rand(1, 10000000);
        }

        $data['role']         = 2;
        // $data['is_deletable'] = 1;
        $data['password']     = bcrypt($request->password);

        try {
            User::create($data);
            return response()->json(['message' => 'Registration Success, Now Login'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('frontend.index');
    }
}

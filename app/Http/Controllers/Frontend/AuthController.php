<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function signIn()
    {
        return view('frontend.sign-in');
    }

    public function signUp()
    {
        return view('frontend.sign-up');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'min:4', 'max:80'],
            'email'    => ['required', 'string', 'min:4', 'max:80'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if (User::where('email', $request->email)->first()) {
                Alert::error('Error', 'This email address already used');
                return back();
            }
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
        }
        $data['role']         = 2;
        $data['password']     = bcrypt($request->password);

        try {
            User::create($data);
            Alert::success('Success', 'User created successfully');
            return back();
        } catch (\Exception $e) {
            return $e->getMessage();
            Alert::error('Error', 'Something went wrong, please try again');
            return back();
        }
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('index');
    }
}

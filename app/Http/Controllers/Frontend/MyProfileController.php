<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class MyProfileController extends Controller
{
    public function index()
    {
        return view('frontend.my-profile');
    }

    public function update(Request $request, $encryptId)
    {
        $data = $request->validate([
            'name'             => ['required', 'string', 'min:5', 'max:80'],
            'email'            => ['required', 'string', 'min:1', 'max:80'],
            // 'image'            => ['nullable', 'string', 'min:1', 'max:30'],
            'phone'            => ['required', 'string', 'min:10', 'max:30'],
            'address'          => ['required', 'string', 'min:10', 'max:255'],
        ]);

        try {
            User::findOrFail(Crypt::decrypt($encryptId))->update($data);
            Alert::success('Success', 'The information has been updated');
        } catch (\Exception $e) {
            Alert::error('Oops', 'Something went wrong, Please try again');
        }
        return back();
    }
}

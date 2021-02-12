<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    // get
    public function index()
    {
        return view('auth.change-password');
    }

    // update
    public function patch(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);
        $user = $request->user();

        if (Hash::check($request->input('current_password'), $user->password)) {
            $user->password = Hash::make($request->input('new_password'));
            $user->has_temp_pass = false;
            $user->save();
            return redirect()->route('dashboard')
                ->with('message', 'Password was successfully changed');
        }
        return redirect()->back()
            ->with('error', 'The current password provided is incorrect');
    }
}

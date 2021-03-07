<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function showLoginForm() {
        return view('auth.login-student');
    }

    public function login(Request $request) {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('student')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('home');
        }   
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest:student')->except('studentLogout');
    }

    public function showLoginForm() {
        return view('auth.login-student');
    }

    public function login(Request $request) {
        
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $student = Student::where('username', $request->username)->with('company_student')->latest('id')->first();

        if($student->company_student->status !== 'success') {
            if(Auth::guard('student')->attempt(['username' => $request->username, 'password' => $request->password])) {
                return redirect('home');
            }
            return back()->with(['success' => false, 'msg' => 'These credentials do not match our records.']);
        } else {
            return back()->with(['success' => true, 'msg' => 'คุณทำข้อสอบเรียบร้อยแล้ว.']);
        }
       
    }

    public function studentLogout() {
        Auth::guard('student')->logout();

        return redirect()->route('login.student');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function update(Request $request) {
        $student = Student::find($request->student_id);

        $password = strtolower(explode(' ', $request->name)[0]);

        $student->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($password),
        ]);

        return redirect()->route('company.index', [$student->company_student]);
    }
}

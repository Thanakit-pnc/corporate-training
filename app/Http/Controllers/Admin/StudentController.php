<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function update(Request $request) {

        $student = Student::find($request->student_id);

        $student->update([
            'name' => $request->name,
            'username' => $request->username,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->mobile)
        ]);

        return redirect()->route('group.index', [$student->student_result->group_id]);
    }
}

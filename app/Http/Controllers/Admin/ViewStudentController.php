<?php

namespace App\Http\Controllers\Admin;

use App\StudentResult;
use App\CompanyStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewStudentController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web')->except(['index', 'update']);
    }

    public function index(CompanyStudent $company_student) {

        $results = StudentResult::where('comp_std_id', $company_student->id)->get();

        return view('admin.students.index', [
            'company_student' => $company_student,
            'results' => $results
        ]);
    }

    public function update(StudentResult $student_result, Request $request) {

        if(StudentResult::whereNull('score')->count() === 1) {
            $company_student = CompanyStudent::find($student_result->comp_std_id);

            $company_student->update([
                'status' => 'success'
            ]);
        }

        if(isset($request->comment)) {
            $this->validate($request, [
                'score' => 'required|numeric',
                'comment' => 'required|present|nullable',
            ]);
            $request->student_result->update([
                'score' => $request->score,
                'comment' => $request->comment
            ]);
        } else {
            $request->student_result->update([
                'score' => $request->score,
            ]);
        }
        
        return back();
    }
}

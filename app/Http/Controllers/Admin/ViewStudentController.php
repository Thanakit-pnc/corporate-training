<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\StudentResult;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewStudentController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web')->except(['index', 'update']);
    }

    public function index($company_id, $student_id) {
        
        $company = Company::find($company_id);

        $result = $company->student_results()->where('student_id', $student_id)->first();

        return view('admin.students.index', [
            'result' => $result
        ]);
    }

    public function update(Request $request) {

        $this->validate($request, [
            'score' => 'required|numeric',
            'comment' => 'required',
        ]);

        $student_result = StudentResult::where('group_id', $request->group_id)
                    ->where('student_id', $request->student_id)
                    ->update([
                        'score' => $request->score,
                        'comment' => $request->comment
                    ]);

        return back()->with('msg', 'Update Successfully.');
    }
}

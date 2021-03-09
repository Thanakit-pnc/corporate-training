<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewStudentController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web');
    }

    public function index($company_id, $student_id) {
        
        $company = Company::find($company_id);

        $result = $company->student_results()->where('student_id', $student_id)->first();

        return view('admin.students.index', [
            'result' => $result
        ]);
    }
}

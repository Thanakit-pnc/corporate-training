<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Student;
use App\CompanyStudent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web')->except(['index']);
    }

    public function index(Company $company) {

        return view('admin.company.index', [
            'company' => $company
        ]);
    }

    public function store(Company $company, Request $request) {

        $this->validate($request, [
            'username.*' => 'unique:students,username',
            'mobile.*' => 'min:10|numeric'
        ],[
            'unique' => 'username has already been taken.',
            'min' => 'mobile must be at least 10 characters.'
        ]);

        for($i = 0; $i < $company->amount; $i++) {

            if(!empty($request->name[$i])) {
                $data = [
                    'name' => $request->name[$i],
                    'username' => $request->username[$i],
                    'mobile' => $request->mobile[$i],
                    'password' => bcrypt($request->mobile[$i]),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                

                $student = Student::create($data);

                $groups[] = [
                    'company_id' => $company->id,
                    'student_id' => $student->id,
                ];
            }
        }

        CompanyStudent::insert($groups);

        return back()->with(['msg' => 'Create student successfully.']);
    } 

    public function ex_students($company_id) {
     
        $students = Student::whereDoesntHave('company_student', function ($query) use ($company_id) {
            $query->where('company_id', '=', $company_id);
        })->get();

        return view('admin.company.ex-students', [
            'students' => $students,
            'company_id' => $company_id
        ]);
    }

    public function checkToAdd(Request $request, $company_id) {

        if(!isset($request->check)) {
            return back()->with(['msg' => 'Please select at least 1']);
        }
        
        for ($i = 0; $i < count($request->check); $i++) { 
            $data[] = [
                'company_id' => $company_id,
                'student_id' => $request->check[$i],
                'status' => 'pending',
            ];
        }

        CompanyStudent::insert($data);

        return redirect()->route('group.company', [$company_id])->with(['msg' => 'Add student to group successfully.']);
    }
}

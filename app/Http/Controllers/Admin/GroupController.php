<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Student;
use App\GroupStudent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web');
    }

    public function index($id) {

        $company = Company::where('id', $id)->with('group_student')->first();

        return view('admin.groups.index', [
            'company' => $company
        ]);
    }

    public function store(Request $request, $company_id) {

        $this->validate($request, [
            'username.*' => 'unique:students,username',
            'mobile.*' => 'min:10'
        ],[
            'unique' => 'username has already been taken.',
            'min' => 'mobile must be at least 10 characters.'
        ]);

        for($i = 0; $i < count($request->name); $i++) {

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

                $companies[] = [
                    'company_id' => $company_id,
                    'student_id' => $student->id,
                ];
            }
        }

        // GroupStudent::insert($companies);

        return back()->with(['msg' => 'Create student successfully.']);
    } 
}

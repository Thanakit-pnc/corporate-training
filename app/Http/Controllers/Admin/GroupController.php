<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Student;
use App\StudentResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web');
    }

    public function index($id) {

        $company = Company::where('id', $id)->with(['student_results', 'dataset_company'])->first();

        return view('admin.groups.index', [
            'company' => $company
        ]);
    }

    public function store(Request $request, $group_id) {

        $this->validate($request, [
            'username.*' => 'unique:students,username',
            'mobile.*' => 'min:10|numeric'
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
                    'group_id' => $group_id,
                    'student_id' => $student->id,
                ];
            }
        }

        StudentResult::insert($companies);

        return back()->with(['msg' => 'Create student successfully.']);
    } 

    public function students($group_id) {

        $students = Student::whereDoesntHave('student_result', function ($query) use ($group_id) {
            $query->where('group_id', '=', $group_id);
        })->get();

        return view('admin.groups.students', [
            'students' => $students,
            'group_id' => $group_id
        ]);
    }

    public function checkToAdd(Request $request, $group_id) {

        if(!isset($request->check)) {
            return back()->with(['msg' => 'Please select at least 1']);
        }
        
        for ($i = 0; $i < count($request->check); $i++) { 
            $data[] = [
                'group_id' => $group_id,
                'student_id' => $request->check[$i]
            ];
        }

        StudentResult::insert($data);

        return redirect()->route('group.index', [$group_id])->with(['msg' => 'Add student to group successfully.']);
    }
}
<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\StudentResult;
use App\CompanyStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function index() {
        
        $company_student = CompanyStudent::where('student_id', auth('student')->id())->latest('id')->first();

        return view('exam', [
            'company_student' => $company_student
        ]);
    }

    public function store(Request $request) {

        DB::beginTransaction();
        
        try {

            $company_student = CompanyStudent::find($request->comp_std_id);

            $company_student->status = 'success';
            $company_student->sent_at = Carbon::now();
            $company_student->save();
            
            StudentResult::insert([
                [
                    'comp_std_id' => $request->comp_std_id,
                    'task' => 1,
                    'body' => $request->body1,
                ],
                [
                    'comp_std_id' => $request->comp_std_id,
                    'task' => 2,
                    'body' => $request->body2,
                ]
            ]);

            DB::commit();

            return redirect('success');

        } catch(\Exception $e) {
            DB::rollback();
            dd($e);
            return back();
        }
        
    }
}

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

            for ($i = 1; $i <= 2; $i++) { 
                
                StudentResult::create([
                    'comp_std_id' => $request->input('comp_std_id'),
                    'task' => $i,
                    'body' => $request->input('body'.$i)
                ]);

            }

            DB::commit();

            return redirect('success');

        } catch(\Exception $e) {
            DB::rollback();
            dd($e);
            return back();
        }
        
    }
}

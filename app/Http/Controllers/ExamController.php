<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\StudentResult;
use App\CompanyStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ExamController extends Controller
{
    public function index() {
        
        $company_student = CompanyStudent::where('student_id', auth('student')->id())
            ->whereNull('status')
            ->first();

        return view('exam', [
            'company_student' => $company_student
        ]);
    }

    public function store(Request $request) {
        
        Session::put('body1', $request->body1);
        Session::put('body2', $request->body2);

        DB::beginTransaction();
        
        try {
            $company_student = CompanyStudent::find($request->comp_std_id);
            
            $company_student->status = 'sent';
            $company_student->sent_at = Carbon::now();
            $company_student->save();
            
            for ($i = 1; $i <= 2; $i++) { 
                
                $results[] = [
                    'comp_std_id' => $request->comp_std_id,
                    'task' => $i,
                    'body' => $request->input('body'.$i),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

            }

            $results = StudentResult::insert($results);

            if($company_student && $results) {
                DB::commit();
    
                return redirect('success');
            }

        } catch(\Exception $e) {
            DB::rollback();
            dd($e);
            return back();
        }
        
    }
}

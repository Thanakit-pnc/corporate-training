<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\StudentResult;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index($number) {
        return view('exam', [
            'number' => $number
        ]);
    }

    public function store($number, Request $request) {

        $student_result = StudentResult::where('student_id', auth('student')->id())
            ->where('status', '!=', 'success')
            ->latest('sent_at')
            ->first();
        
        StudentResult::where('group_id', $student_result->group_id)
                    ->where('student_id', auth('student')->id())
                    ->update([
                        'task' => $number,
                        'text_result' => $request->body,
                        'status' => 'success',
                        'sent_at' => Carbon::now()
                    ]);
        
        return redirect('success');
    }
}

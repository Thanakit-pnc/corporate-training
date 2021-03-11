<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\Student;
use Illuminate\Http\Request;
use App\Mail\StudentInformation;
use App\Http\Controllers\Controller;

class SendMailController extends Controller
{
    public function sendMail() {

        $students = Student::with('company_student')->get();

        $content = [
            'title' => 'Username for Corporate training.',
            'content' => 'Some Content.',
            'students' => $students
        ];

        $receiveEmail = 'thanakit.p@newcambridge.net';

        Mail::to($receiveEmail)->send(new StudentInformation($content));

    }
}

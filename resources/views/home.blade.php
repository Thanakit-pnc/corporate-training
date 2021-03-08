@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="my-0 text-white">รายละเอียดในการสอบ</h4>
                </div>
                <div class="card-body">
                    <h4 class="mt-0 mb-3 text-center"><i class="fas fa-clock"></i> เวลาในการทำสอบ <span class="text-danger font-weight-bold"> 70 นาที </span></h4>
                    <p class="mb-0"><i class="fas fa-quote-left"></i> กรุณาเตรียมความพร้อมก่อนเริ่มทำข้อสอบ เมื่อกด <span class="text-danger font-weight-bold">Start</span> ระบบจะเริ่มทำการจับเวลาทันทีและท่านจะสามาถทำข้อสอบได้เพียง 1 ครั้งเท่านั้น <i class="fas fa-quote-right"></i> </p>
                </div>
                <div class="card-footer text-center bg-custom">
                    <a href="{{ route('exam.test', [rand(1,2)]) }}" class="btn btn-primary width-lg font-weight-bold">Start</a>
                </div>
            </div>
        </div>
    </div>
@endsection

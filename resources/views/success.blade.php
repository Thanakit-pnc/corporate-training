@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="col-md-12">
            <img src="{{ asset('public/assets/images/success.jpg') }}" alt="" width="650px">
        </div>
        <div class="col-md-12">
            <h3 class="my-5"><i class="fas fa-check-circle text-success fa-2x align-middle"></i> This section is now complete.</h3>

            <a href="{{ route('logout.student') }}" class="btn btn-success width-lg">Accept</a>
        </div>
    </div>
@endsection
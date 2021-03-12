@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="display-6 my-0"><i class="fas fa-building"></i> : {{ $company_student->company->company_name }} | <i class="fas fa-user-circle"></i> {{ $company_student->student->name }} | <i class="fas fa-phone"></i> {{ $company_student->student->mobile }}</h4>
                    <h5 class="my-0">Sent Date : {{ $company_student->sent_at->format('d/M/Y H:i') }}</h5>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-auto">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link {{ empty(session('tab')) ? 'active' : '' }} mb-2" id="task1-tab" data-toggle="pill" href="#task1" role="tab" aria-controls="task1" aria-selected="true">Task 1</a>
                            <a class="nav-link {{ in_array(session('tab'), [1, 2]) ? 'active' : '' }} mb-2" id="task2-tab" data-toggle="pill" href="#task2" role="tab" aria-controls="task2" aria-selected="false">Task 2</a>
                        </div>
                    </div>
                    <div class="col-sm">
                       
                        <div class="tab-content p-0">
                            @foreach ($results as $result)

                                @php
                                    if(empty(session('tab'))) {
                                        $loopActive = $loop->first;
                                    } else if(in_array(session('tab'), [1, 2])) {
                                        $loopActive = $loop->last;
                                    }
                                @endphp

                                <div class="tab-pane fade {{ $loopActive ? 'show active' : '' }}" id="task{{ $result->task }}" role="tabpanel" aria-labelledby="task{{ $result->task }}-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @include('exam.task'.$result->task)
                                        </div>
                                        <div class="col-md-6">
                                            <textarea class="mytextarea">{{ $result->body }}</textarea>
                                        </div>
                                    </div>
                                    
                                    @include('admin.students.score-comment', [$result])
                                </div>
                            @endforeach
                            
                            <div class="text-right">
                                <a href="{{ route('company.index', [$company_student->company_id]) }}" class="btn btn-info btn-sm">Finish</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        tinymce.init({
            selector: '.mytextarea',
            plugins: 'wordcount',
            toolbar: false,
            menubar: false,
            placeholder: 'Type here...',
            height: 400,
            readonly : 1
        });

    </script>
@endsection

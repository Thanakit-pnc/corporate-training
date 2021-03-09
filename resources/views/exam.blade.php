@extends('layouts.app')

@section('content')
    <div class="card-box">
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <div class="d-flex justify-content-between">
                    <h3 class="my-0">Task {{ $number }}</h3>
                    <h3 id="timer" class="my-0">70:00</h3>
                </div>
            </div>
            <div class="col-md-6">
                @include('exam.task'.$number)
            </div>
            <div class="col-md-6">
                <form action="{{ route('exam.test', [$number]) }}" method="post" id="form-text">
                    {{ csrf_field() }}
                    <textarea id="mytextarea" name="body"></textarea>
                </form>
            </div>

            <div class="col-md-12 mt-4 text-center">
                <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('public/js/timer.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            plugins: 'wordcount',
            toolbar: false,
            menubar: false,
            placeholder: 'Type here...',
            height: 400
        });

        $('body').on('contextmenu', function(e){
            e.preventDefault();
        });

        $('#submitBtn').click(function(e) {
            e.preventDefault()

            Swal.fire(
                {
                    title:"Are you sure",
                    text:"You want to submit?",
                    type:"warning",
                    showCancelButton:!0,
                    confirmButtonText:"Yes",
                    cancelButtonText:"Cancel",
                    confirmButtonClass:"btn btn-success mt-2",
                    cancelButtonClass:"btn btn-secondary ml-2 mt-2",
                    buttonsStyling:!1
                }).then(function (t) {
                    if(t.value) {
                        $('#form-text').submit()
                    }
                })
        })
    </script>
@endsection
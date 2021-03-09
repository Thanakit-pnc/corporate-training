@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="display-6 my-0"><i class="fas fa-building"></i> : {{ $result->company->dataset_company->company_name }} | <i class="fas fa-user-circle"></i> {{ $result->student->name }} | <i class="fas fa-phone"></i> {{ $result->student->mobile }}</h4>
                    <h5 class="my-0">Sent Date : {{ $result->sent_at->format('d/F/Y H:i') }}</h5>
                </div>
                <div class="row mt-2 text-dark">
                    <div class="col-md-12">
                        @if (!empty($result->score))
                            
                        @endif
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        @include('exam.task'.$result->task)
                    </div>
                    <div class="col-md-6">
                        <form action="#" method="post">
                            {{ csrf_field() }}

                            <textarea id="mytextarea" name="body">{!! $result->text_result !!}</textarea>

                            <div class="mt-2 text-right">
                                <button id="copy" type="button" class="btn btn-purple btn-sm" data-toggle="tooltip" data-placement="top" title="Copy URL">
                                    <i class="fas fa-clipboard"></i>
                                </button>
                                @if (auth()->user()->role === 'admin')
                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                @endif
                            </div>
                        </form>

                        <a href="{{ route('admin.dashboard') }}" id="url">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let role = "{{ auth()->user()->role }}"

        tinymce.init({
            selector: '#mytextarea',
            plugins: 'wordcount',
            toolbar: false,
            menubar: false,
            placeholder: 'Type here...',
            height: 400,
            readonly : role === 'admin' ? 0 : 1 
        });

        $('#copy').click(copyUrl)

        function copyUrl() {

            let el = document.createElement('textarea');
            let url = document.getElementById('url');
            el.value = url.getAttribute('href');

            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');

            $(this).tooltip('hide')
                .attr('data-original-title', 'Copied!')
                .tooltip('show');

            document.body.removeChild(el);
        }
    </script>
@endsection

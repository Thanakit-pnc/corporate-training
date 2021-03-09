@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="display-6 my-0"><i class="fas fa-building"></i> : {{ $result->company->dataset_company->company_name }} | <i class="fas fa-user-circle"></i> {{ $result->student->name }} | <i class="fas fa-phone"></i> {{ $result->student->mobile }}</h4>
                    <h5 class="my-0">Sent Date : {{ $result->sent_at->format('d/F/Y H:i') }}</h5>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        @include('exam.task'.$result->task)
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('view.update') }}" method="post" onsubmit="return confirm('Are you sure you want to update ?')">
                            {{ csrf_field() }}

                            <textarea id="mytextarea" @if(Auth::check() && auth()->user()->role === 'admin') name="body" @endif>{!! $result->text_result !!}</textarea>


                            @empty($result->score || $result->comment)
                                <div class="mt-2 text-right">
                                    @if (Auth::check() && auth()->user()->role === 'admin' || auth()->guest())
                                    <input type="hidden" name="group_id" value="{{ $result->group_id }}">
                                    <input type="hidden" name="student_id" value="{{ $result->student->id }}">

                                    <div class="form-group text-left">
                                        <label for="score">Score</label>
                                        <input type="text" name="score" placeholder="Score" class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }}" value="{{ old('score') }}">
                                        @if($errors->has('score'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('score') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="comment">Comment</label>
                                        <textarea name="comment" cols="30" rows="10" class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" placeholder="Comment">{{ old('comment') }}</textarea>
                                        @if($errors->has('comment'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('comment') }}
                                            </div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                    @endif
                                    
                                    @if(Auth::check())
                                    <button id="copy" type="button" class="btn btn-purple btn-sm" data-toggle="tooltip" data-placement="top" title="Copy URL">
                                        <i class="fas fa-clipboard"></i>
                                    </button>  
                                    @endif
                                </div>
                            @else
                                <div class="mt-3">
                                    <h4>Score : {{ $result->score }}</h4>
                                    <hr>
                                    <h4>Comment</h4>
                                    <p>
                                        {{ $result->comment }}
                                    </p>
                                </div>
                            @endempty

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        let role = "{{ Auth::check() && auth()->user()->role == 'admin' ? 0 : 1}}";

        tinymce.init({
            selector: '#mytextarea',
            plugins: 'wordcount',
            toolbar: false,
            menubar: false,
            placeholder: 'Type here...',
            height: 400,
            readonly : +role
        });

        $('#copy').click(copyUrl)

        function copyUrl() {

            let el = document.createElement('textarea')
            el.value = location.href

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

@extends('layouts.app')

@section('content')
    <div class="card-box">
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <h3 id="timer" class="my-0">70:00</h3>
            </div>

            <div class="col-md-12">
                <form method="post" id="form-text">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="comp_std_id" value="{{ $company_student->id }}">

                    <div id="wizard">
                        <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                            <li class="nav-item">
                                <a href="#task1" data-toggle="tab" class="nav-link active"> 
                                    <span class="number">1</span>
                                    <span class="d-none d-sm-inline">Task 1</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#task2" data-toggle="tab" class="nav-link">
                                    <span class="number">2</span>
                                    <span class="d-none d-sm-inline">Task 2</span>
                                </a>
                            </li>
                        </ul>
        
                        <div class="tab-content b-0 mb-0">
                            <div class="tab-pane show active" id="task1">
                                <div class="row">
                                    <div class="col-md-6">
                                        @include('exam.task1')
                                    </div>
                                    <div class="col-md-6">
                                        <textarea id="mytextarea1" name="body1"></textarea>
                                    </div>
                                </div>
                            </div>
        
                            <div class="tab-pane" id="task2">
                                <div class="row">
                                    <div class="col-md-6">
                                        @include('exam.task2')
                                    </div>
                                    <div class="col-md-6">
                                        <textarea id="mytextarea2" name="body2"></textarea>
                                    </div>
                                </div>
                            </div>
    
                            <ul class="list-inline wizard mb-0 mt-4">
                                <li class="previous list-inline-item">
                                    <a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                                </li>
                                <li class="next list-inline-item float-right">
                                    <a href="javascript: void(0);" class="btn btn-secondary">Next</a>
                                </li>
                                <li class="finish list-inline-item float-right">
                                    <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                 </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('public/js/timer.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea1, #mytextarea2',
            plugins: 'wordcount',
            toolbar: false,
            menubar: false,
            placeholder: 'Type here...',
            height: 400
        });

        $('#wizard').bootstrapWizard(
			{'nextSelector': '.next', 
			'previousSelector': '.previous',
			'onTabShow': function(tab, navigation, index) {
				var $total = navigation.find('li').length;
				var $current = index+1;
				var $percent = ($current/$total) * 100;
				$('#rootwizard').find('.bar').css({width:$percent+'%'});

				if($current >= $total) {
					$('#wizard').find('.list-inline .next').hide();
					$('#wizard').find('.list-inline .finish').show();
					$('#wizard').find('.list-inline .finish').removeClass('disabled');
				} else {
					$('#wizard').find('.list-inline .next').show();
					$('#wizard').find('.list-inline .finish').hide();
				}
			}
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
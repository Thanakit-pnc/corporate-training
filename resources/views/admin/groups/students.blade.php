@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="mt-0">Student All</h4>

                @if (session('msg'))
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ session('msg') }}
                </div>
                @endif
        
                <form action="{{ route('check-to-add', [$group_id]) }}" method="post">
                    {{ csrf_field() }}
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="select-all">
                                        <label class="custom-control-label" for="select-all"></label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="check[]" id="check{{ $student->id }}" value="{{ $student->id }}">
                                            <label class="custom-control-label" for="check{{ $student->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $student->name }}
                                    </td>
                                    <td>
                                        {{ $student->mobile }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add To Group</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#select-all').on('change', function() {
            if($(this).is(':checked')) {
                $('input[name="check[]"]').attr('checked', true)
            } else {
                $('input[name="check[]"]').attr('checked', false)
            }
        })
    </script>
@endsection
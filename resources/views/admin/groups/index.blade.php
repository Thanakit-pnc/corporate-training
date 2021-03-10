@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="my-0">{{ $company->company_name }} ( {{ $company->amount }} {{ str_plural('Person', $company->amount) }} )</h3>
                    <p class="text-primary mb-0 font-weight-bold">Created at : {{ $company->created_at->format('d/F/Y H:i') }}</p>
                </div>

                @if ($company->company_students->count() !== $company->amount)
                    <div class="text-right mt-2">
                        <a href="{{ route('students.all', [$company->id]) }}" class="btn btn-primary waves-effect waves-light">eX Student</a>
                    </div>
                @endif

                <div class="mt-3">

                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    
                    @if($company->company_students->count())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th>Sent date</th>
                                    <th>Score 1 & 2</th>
                                    <th>O/V</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($company->company_students as $group)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $group->student->name }}</td>
                                        <td>{{ $group->student->username }}</td>
                                        <td>{{ $group->student->mobile }}</td>
                                        <td>
                                            <span class="badge badge-{{ $group->status == 'success' ? 'success' : 'warning' }}">{{ ucfirst($group->status) }}</span>
                                        </td>
                                        <td>{{ !empty($group->sent_at) ? $group->sent_at->format('d/m/Y H:i') : '' }}</td>
                                        <td>
                                            @if ($group->student_results->count())
                                                <span class="badge badge-pill badge-primary">{{ $group->student_results[0]->score }}</span>
                                                <span class="badge badge-pill badge-purple">{{ $group->student_results[1]->score }}</span>
                                            @endif
                                        </td> 
                                        <td>
                                            @if ($group->student_results->count() && $group->student_results[0]->score)
                                                {{ ($group->student_results[0]->score + $group->student_results[1]->score) / 2 }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($group->status === 'success')
                                                <a href="{{ route('view.index',[$group]) }}" class="btn btn-info btn-sm">View</a>
                                            @endif
                                            @if (Auth::check())
                                                <button class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#edit{{ $group->student->id }}">Edit</button>
                                                @include('admin.modal.edit-student', [$group])
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    
                    @if($company->amount !== $company->company_students->count())
                    <form action="{{ route('company.store', [$company]) }}" method="post">
                        {{ csrf_field() }}

                        <table class="table table-bordered">
                        @for ($i = 0; $i < ($company->amount - $company->company_students->count()); $i++)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="name[]" placeholder="Name">
                                </td>
                                <td>
                                    <input type="text" class="form-control @if($errors->has('username.'.$i)) is-invalid @endif" name="username[]" placeholder="Username" value="{{ old('username.'.$i) }}">
                                    @if ($errors->has('username.'.$i))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('username.'.$i) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <input type="text" class="form-control @if($errors->has('mobile.'.$i)) is-invalid @endif" name="mobile[]" placeholder="Mobile" value="{{ old('mobile.'.$i) }}">
                                    @if ($errors->has('mobile.'.$i))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('mobile.'.$i) }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endfor
                        </table>

                        <div class="form-group text-center">
                            <button class="btn btn-success width-lg">Add</button>
                        </div>
                    </form>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="my-0">{{ $company->company_name }} ( {{ $company->amount }} {{ str_plural('Person', $company->amount) }} )</h3>
                    <p class="text-muted mb-0">Created at : {{ $company->created_at->format('d/F/Y H:i:s') }}</p>
                </div>

                <div class="mt-3">

                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    
                    @if($company->group_student->count())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Mobile</th>
                                    <th>Score</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($company->group_student as $group)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $group->student->name }}</td>
                                        <td>{{ $group->student->username }}</td>
                                        <td>{{ $group->student->mobile }}</td>
                                        <td>{{ $group->score }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm">View</button>
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if($company->amount !== $company->group_student->count())
                    <form action="{{ route('group.store', [$company->id]) }}" method="post">
                        {{ csrf_field() }}

                        <table class="table table-bordered">
                        @for ($i = 0; $i < ($company->amount - $company->group_student->count()); $i++)
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
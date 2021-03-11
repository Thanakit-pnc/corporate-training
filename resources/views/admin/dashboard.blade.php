@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card-box">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Trainee</th>
                            <th>Expire Date</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>
                                    <a href="{{ route('company.index', [$company]) }}">{{ $company->company_name }}</a>
                                </td>
                                <td>
                                   <strong> ({{ $company->company_students()->success()->count() }})</strong> {{ $company->amount }}
                                </td>
                                <td>
                                    @if (!empty($company->expire_date))
                                        {{ $company->expire_date->format('d/M/Y') }}
                                    @endif
                                </td>
                                <td>
                                    {{ $company->created_at->format('d/M/Y H:i') }}
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#edit_company{{ $company->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @include('admin.modal.edit-company', [$company])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box">
                <h4 class="mt-0 text-muted">Create Group</h4>

                @if (session('msg'))
                    <div class="alert alert-success">
                        {{ session('msg') }}
                    </div>
                @endif

                <form action="{{ route('create-group') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" class="form-control @if($errors->has('company')) is-invalid @endif" name="company" value="{{ old('company') }}" placeholder="Company">
                        @if ($errors->has('company'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="amount">Trainee</label>
                        <input type="text" class="form-control @if($errors->has('trainee')) is-invalid @endif" name="trainee" placeholder="Trainee" value="{{ old('trainee') }}">
                        @if ($errors->has('trainee'))
                            <div class="invalid-feedback">
                                {{ $errors->first('trainee') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection

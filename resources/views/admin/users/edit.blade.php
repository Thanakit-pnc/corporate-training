@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session('msg'))
                <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ session('msg') }}
                </div>
            @endif
        </div>
        <div class="col-md-7">
            <div class="card-box">
                <h3 class="mt-0"><i class="fas fa-edit"></i> Edit User</h3>

                <form action="{{ route('users.update', ['id' => $user->id]) }}" method="post" class="mt-2">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="username" class="control-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ $user->username }}">
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->id !== $user->id)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role" class="control-label">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option selected disabled>--Select--</option>
                                    <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                    <option value="teacher" @if($user->role == 'teacher') selected @endif>Teacher</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="form-group text-center">
                        <button class="btn btn-success width-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-box">
                <h3 class="mt-0"><i class="fas fa-key"></i> Edit Password</h3>

                <form action="{{ route('users.update_password', ['id' => $user->id]) }}" method="post" class="mt-2">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" name="password" placeholder="Password">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password_confirmation" class="control-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-success width-lg">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="my-0"><i class="fas fa-users"></i> Users</h3>
                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#add_user"><i class="fas fa-plus-circle"></i> Add</button>
                    @include('admin.modal.add-user')
                </div>

                <table id="basic-datatable" class="table dt-responsive table-striped nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#form-add-user').on('submit', (e) => {
            e.preventDefault();
            
            $.ajax({
                url: "{{ route('admin.store') }}",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: $('input[name="name"]').val(),
                    username: $('input[name="username"]').val(),
                    password: $('input[name="password"]').val(),
                    role: $('select[name="role"]').val(),
                },
                success: function(res) {
                    
                }
            })
        })
    </script>
@endsection
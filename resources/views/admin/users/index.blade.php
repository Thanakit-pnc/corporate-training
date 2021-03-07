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

                @if (session('msg'))
                    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        {{ session('msg') }}
                    </div>
                @endif

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
                                    <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-sm waves-effect waves-light"><i class="fas fa-edit"></i></a>
                                    @if(auth()->user()->id !== $user->id) 
                                        <button class="btn btn-danger btn-sm sa-delete" data-info="{{ $user }}"><i class="fas fa-trash-alt"></i></button>
                                    @endif
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
                url: "{{ route('users.store') }}",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: $('input[name="name"]').val(),
                    username: $('input[name="username"]').val(),
                    password: $('input[name="password"]').val(),
                    role: $('select[name="role"]').val(),
                },
                success: function(res) {
                    if(!res.success) {

                        $('#errors').html(`
                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul id="errorBag" class="mb-0"></ul>
                            </div>
                        `)

                        for(let error in res.errors) {
                            $(`<li>${res.errors[error][0]}</li>`).appendTo($('#errorBag'))
                        }

                        removeErrors()
                    } else {
                        $('#add_user').modal('hide')
                        $('#form-add-user')[0].reset()
                        location.reload()
                    }
                },  
            })
        })

        $(document).on('click', '.sa-delete', function() {
            let data = $(this).data('info')

            Swal.fire({title:"Are you sure?",
                text:`You want to delete ${data.name}`,
                type:"warning",
                showCancelButton:!0,
                confirmButtonColor:"#3085d6",
                cancelButtonColor:"#d33",
                confirmButtonText:"Yes, delete it!"
            }).then(function(t){
                if(t.value) {
                    $.ajax({
                        url: 'delete_user/' + data.id,
                        success: function(res) {
                            if(res.msg) {
                                Swal.fire("Deleted!",`${data.name} has been deleted.`,"success").then(function(t) { t.value && location.reload()})
                            }
                        }
                    })
                }
            })
        })

        function removeErrors() {
            setTimeout(() => {
                $('#errors .alert').remove()
            }, 5000)
        }
    </script>
@endsection
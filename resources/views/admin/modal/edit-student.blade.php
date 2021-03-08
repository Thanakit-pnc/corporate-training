<div id="edit{{ $group->student->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title text-white">Edit</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="{{ route('student.update') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="student_id" value="{{ $group->student->id }}">
                <div class="modal-body p-4">
                    <div id="errors"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $group->student->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="username" class="control-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ $group->student->username }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mobile" class="control-label">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{ $group->student->mobile }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning waves-effect waves-light">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
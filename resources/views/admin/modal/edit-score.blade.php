<div id="edit_score{{ $result->task }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-white">Edit Score</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="{{ route('view.update', [$result]) }}" method="post">
                {{ csrf_field() }}

                <div class="modal-body p-4 text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="score" class="control-label">Score</label>
                                <input type="text" class="form-control" id="score" name="score" placeholder="Score" value="{{ $result->score }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark waves-effect waves-light">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
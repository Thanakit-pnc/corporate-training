@if (empty($result->score))
    <form action="{{ route('view.update', [$result]) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="task" value="{{ $result->task }}">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="score">Score Task {{ $result->task }}</label>
                    <input type="text" class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }}" name="score" placeholder="Score">
                    @if ($errors->has('score'))
                        <div class="invalid-feedback">
                            {{ $errors->first('score') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="comment">Comment Task {{ $result->task }}</label>
                    <textarea name="comment" class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" placeholder="Comment" rows="10"></textarea>
                    @if ($errors->has('comment'))
                        <div class="invalid-feedback">
                            {{ $errors->first('comment') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-success">Update Task {{ $result->task }}</button>
            </div>
        </div>
    </form>
@else
    <div class="row mt-3">
        <div class="col-md-12">
            <h4>Score : {{ $result->score }}</h4> 
            <hr>
            <h4>Comment :</h4>
            <p>
                {{ $result->comment }}
            </p>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12 text-center">
            <button button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#edit_score{{ $result->task }}">Edit</button>
            @include('admin.modal.edit-score', [$result])
        </div>
    </div>
@endif
@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Amount</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>
                                    <a href="{{ route('group.index', [$company->id]) }}">{{ $company->dataset_company->company_name }}</a>
                                </td>
                                <td>{{ $company->student_results->count() }} / {{ $company->amount }}</td>
                                <td>
                                    {{ $company->created_at->format('d/F/Y H:i:s') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
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
                        <select name="company" class="form-control @if($errors->has('company')) is-invalid @endif">
                            <option selected disabled>-Select Company-</option>
                            @foreach ($dataset_companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                            <option value="other"  @if(old('company') === 'other') selected @endif>Other</option>
                        </select>
                        @if ($errors->has('company'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company') }}
                            </div>
                        @endif
                    </div>

                    @if($errors->has('company_other'))
                    <div class="form-group">
                        <input type="text" class="form-control @if($errors->has('company_other')) is-invalid @endif" name="company_other" placeholder="Other Company">
                        @if ($errors->has('company_other'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_other') }}
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control @if($errors->has('amount')) is-invalid @endif" name="amount" placeholder="Amount" value="{{ old('amount') }}">
                        @if ($errors->has('amount'))
                            <div class="invalid-feedback">
                                {{ $errors->first('amount') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('select[name="company"]').on('change', function() {
            if($(this).val() === 'other') {
                $(`
                    <div class="form-group">
                        <input type="text" class="form-control @if($errors->has('company_name')) is-invalid @endif" name="company_other" placeholder="Other Company">
                        @if ($errors->has('company_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_name') }}
                        </div>
                        @endif
                    </div>
                `).insertAfter($(this).parent())
            } else {
                $('input[name="company_other"]').parent().remove()
            }
        })
    </script>
@endsection
<div id="edit_company{{ $company->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title text-white">Edit Company</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="{{ route('company.update', [$company]) }}" method="post">
                {{ csrf_field() }}

                <div class="modal-body p-4">
                    <div id="errors"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company" class="control-label">Company</label>
                                <input type="text" class="form-control" id="company" name="company" placeholder="Company" value="{{ $company->company_name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amount" class="control-label">Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" value="{{ $company->amount }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="expire_date" class="control-label">Expire date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" data-provide="datepicker" data-date-autoclose="true" name="expire_date" id="expire_date" placeholder="Expire date" autocomplete="off" required value="{{ !empty($company->expire_date) ? $company->expire_date->format('d/m/Y') : '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ti-calendar"></i></span>
                                    </div>
                                </div>
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

@section('js')
    <script>
        $('#expire_date').datepicker({
            format: 'dd/mm/yyyy',
            orientation: "auto",
        })
    </script>
@endsection
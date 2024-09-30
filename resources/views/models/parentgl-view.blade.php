<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">View Account</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Account Name Field -->
                <div class="form-group">
                    <label for="account_name" class="control-label">Account Name</label>
                    <input type="text" class="form-control" id="account_name" name="account_name"
                        placeholder="Enter Account Name" value="{{ $gl_codes_parent?->name }}" readonly disabled>
                </div>

                <!-- Account Type Field (if needed) -->
                <div class="form-group">
                    <label for="account_type" class="control-label">Account Type</label>
                    <input type="text" class="form-control" id="account_type" name="account_type"
                        placeholder="Account Type" value="{{ $gl_codes_parent?->accountType->name ?? 'N/A' }}" readonly disabled>
                </div>

                <!-- Close Button -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-light" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

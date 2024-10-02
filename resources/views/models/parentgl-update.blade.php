<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Edit Account</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="crudForm" name="crudForm" class="form-horizontal"
                    action="{{ route('gl-codes-parent.update', ['gl_codes_parent' => $glCodesParent->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Account Name Field -->
                    <div class="form-group">
                        <label for="account_name" class="control-label">Account Name</label>
                        <input type="text" class="form-control" id="account_name" name="name"
                            placeholder="Enter Account Name" value="{{ $glCodesParent->name }}" required="">
                    </div>
                    
                    <!-- Account Type Dropdown -->
                    <div class="form-group">
                        <label for="account_type_id" class="control-label">Account Type</label>
                        <select class="form-control" id="account_type_id" name="account_type_id" required>
                            <option value="">Select Account Type</option>
                            @foreach($accountTypes as $accountType)
                                <option value="{{ $accountType->id }}" 
                                    {{ $glCodesParent->account_type_id == $accountType->id ? 'selected' : '' }}>
                                    {{ $accountType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Is Bank Account Checkbox -->
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_bank_account" name="is_bank_account"
                            value="1" {{ $glCodesParent->is_bank_account ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_bank_account">Is Bank Account</label>
                    </div>

                    <!-- Save Button -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                            <button class="btn btn-light" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

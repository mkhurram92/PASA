<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Add an Account</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="crudForm" name="crudForm" class="form-horizontal"
                    action="{{ route('gl-codes-parent.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Account Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Account Name" value="" required="">
                    </div>
                    <!-- <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="Enter Description" value="" required="">
                    </div>
                    New Dropdown for Account Types -->
                    <div class="form-group">
                        <label for="account_type" class="control-label">Account Type</label>
                        <select class="form-control" id="account_type_id" name="account_type_id" required>
                            <option value="">Select Account Type</option>
                            @foreach($accountTypes as $accountType)
                                <option value="{{ $accountType->id }}">{{ $accountType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                                changes</button>
                            <button class="btn btn-light" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="curdModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">View User</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" readonly disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="email" class="control-label">Email</label>
                        <input type="text" class="form-control" value="{{ $user->email }}" readonly disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="role" class="control-label">Role</label>
                        <input type="text" class="form-control" id="role" name="role"
                            value="{{ $roleName }}" readonly disabled>
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-default close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

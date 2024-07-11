<div class="modal fade" id="crudModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">View User</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="text" class="form-control" value="{{ $user->email }}" readonly disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="control-label">Role</label>
                        <input type="text" class="form-control" id="role" name="role" value="{{ $roleName }}" readonly disabled>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-default close-modal" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

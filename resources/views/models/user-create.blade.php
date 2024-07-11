<div class="modal fade" id="crudModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add User</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm" name="userForm" class="form-horizontal" method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <!-- Role selection field -->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="role_id" class="control-label">Role</label>
                            <select class="form-control" id="role_id" name="role_id" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

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

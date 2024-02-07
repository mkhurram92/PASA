<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Update Role</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="curdForm" name="curdForm" class="form-horizontal" method="POST" action="{{ route('roles.update',['role'=>$role?->id]) }}">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Of Role" value="{{$role?->name}}">
                    </div>
                    <hr>
                    <div class="col-12">
                        <h5>Role Permissions</h5>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-semibold">Administrator Access <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input selectAll" type="checkbox" id="selectAllEdit" />
                                                <label class="form-check-label" for="selectAllEdit">
                                                    Select All
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @include('models.show-permissions',["permissions"=>$permissions,'rolePermissions'=>$rolePermissions])
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="form-group mt-4">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary mx-4" id="saveBtn" value="create">Save changes</button>
                            <button class="btn btn-light" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

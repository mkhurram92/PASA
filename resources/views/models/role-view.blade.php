<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Show Role</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name Of Role" value="{{$role?->name}}" disabled readonly>
                </div>
                <hr>
                <div class="col-12">
                    <h5>Role Permissions</h5>
                    <!-- Permission table -->
                    <div class="table-responsive">
                        @include('models.show-permissions',["permissions"=>$permissions,'rolePermissions'=>$rolePermissions,"type"=>"readonly"])
                    </div>
                    <!-- Permission table -->
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-default close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="crudModal" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">View Sub GL Name</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="portNameView" class="control-label">Sub GL Name</label>
                    <input type="text" class="form-control" id="portNameView" value="{{$port?->name}}" disabled>
                </div>
                <div class="form-group">
                    <label for="portNameView" class="control-label">Parent GL Name</label>
                    <input type="text" class="form-control" id="portNameView" value="{{$port?->name}}" disabled>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-default close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

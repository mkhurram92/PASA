<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">View Account</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Account Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter Parent GL Name" value="{{$gl_codes_parent?->name}}" readonly disabled>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Description</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter Parent GL Name" value="{{$gl_codes_parent?->description}}" readonly disabled>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-light" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

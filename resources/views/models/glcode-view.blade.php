<div class="modal fade" id="crudModal" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">View a Sub G/L</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="subNameView" class="control-label">Sub G/L</label>
                    <input type="text" class="form-control" value="{{$glCode?->name}}" disabled readonly>
                </div>
                <div class="form-group">
                    <label class="control-label" for="parent_id">Parent G/L</label>
                    <input class="form-control" value="{{$glCode?->glCodesParent?->name}}" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="subNameView" class="control-label">Description</label>
                    <textarea type="text" class="form-control" rows="4" disabled readonly>{{$glCode?->description}}</textarea>
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

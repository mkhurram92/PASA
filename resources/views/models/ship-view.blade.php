<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Ship Details</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" placeholder="Enter Name Of Ship" value="{{$ship?->name_of_ship}}" disabled readonly>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Tonnage</label>
                    <input type="text" class="form-control" placeholder="Enter Tonnage" value="{{$ship?->tonnage}}" disabled readonly>
                </div>

                <div class="form-group">
                    <label class="control-label" for="rig">Rig</label>
                    <input type="text" class="form-control" placeholder="Enter Tonnage" value="{{$ship?->rigRelation?->name}}" disabled readonly>
                </div>
                <br /><br />
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-default close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

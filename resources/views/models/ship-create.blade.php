<div class="modal fade" id="crudModal" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Add Ship</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="crudForm" name="crudForm" class="form-horizontal" action="{{route('ship.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name_of_ship" name="name_of_ship"
                            placeholder="Enter Name Of Ship" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Tonnage</label>
                        <input type="text" class="form-control" id="tonnage" name="tonnage"
                            placeholder="Enter Tonnage" value="" required="">
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="rig">Rig</label>
                        <select id="rig" name="rig" data-placeholder="Select Rig" class="select2 form-select"></select>
                    </div>
                    <br /><br />
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

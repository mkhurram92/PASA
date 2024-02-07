<div class="modal fade" id="crudModal" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Update Port</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form id="crudForm" name="crudForm" class="form-horizontal" method="POST" action="{{ route('ports.update',['port'=>$port?->id]) }}">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="portNameEdit" class="control-label">Port Name</label>
                        <input type="text" class="form-control" id="portNameEdit" name="name"
                            placeholder="Enter Port Name" value="{{$port?->name}}" >
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

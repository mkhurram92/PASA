<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Create country</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form id="crudForm" name="crudForm" class="form-horizontal" action="{{route('countries.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name Of Country" value="" required="">
                    </div>
                    <div class="form-group">
                        <label for="code" class="control-label">Code</label>
                        <input type="text" class="form-control" id="code" name="code"
                            placeholder="Enter Code Of Country" value="" >
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

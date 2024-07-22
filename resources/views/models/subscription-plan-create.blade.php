<div class="modal fade" id="crudModal" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Subscription Plans</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="statesForm" name="statesForm" class="form-horizontal"
                    action="{{ route('subscription-plans.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Name<span class="tx-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name" value="" required="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Description<span class="tx-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description"
                            placeholder="Enter description" style="height: 100px; overflow-y: auto;" value="" required=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Email Price<span class="tx-danger">*</span></label>
                        <input type="number" class="form-control" id="email_price" name="email_price"
                            placeholder="Enter Email Price" value="" required="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Post Price<span class="tx-danger">*</span></label>
                        <input type="number" class="form-control" id="post_price" name="post_price"
                            placeholder="Enter Post Price" value="" required="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Joining Fee<span class="tx-danger">*</span></label>
                        <input type="number" class="form-control" id="joining_fee" name="joining_fee"
                            placeholder="Enter Joining Fee" value="" required="">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                                changes</button>
                            <button class="btn btn-light" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

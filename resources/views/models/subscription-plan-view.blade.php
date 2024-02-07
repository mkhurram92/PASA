<div class="modal fade" id="crudModal" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">View Subscription Plan</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Name<span class="tx-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                        value="{{ $subscription_plan?->name }}" required="" readonly disabled>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Description<span class="tx-danger">*</span></label>
                    <textarea style="height: 100px; overflow-y: auto;" class="form-control" id="description" name="description"
                        placeholder="Enter Description" required="" readonly disabled>{{ $subscription_plan?->description }}</textarea>

                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Email Price<span class="tx-danger">*</span></label>
                    <input type="number" class="form-control" id="email_price" name="email_price"
                        placeholder="Enter Email Price" value="{{ $subscription_plan?->email_price }}" required=""
                        readonly disabled>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Post Price<span class="tx-danger">*</span></label>
                    <input type="number" class="form-control" id="post_price" name="post_price"
                        placeholder="Enter Post Price" value="{{ $subscription_plan?->post_price }}" required=""
                        readonly disabled>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-default close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

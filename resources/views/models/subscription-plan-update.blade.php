<div class="modal fade" id="crudModal" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Update Subscription Plan</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="statesForm" name="statesForm" class="form-horizontal"
                    action="{{ route('subscription-plans.update', ['subscription_plan' => $subscription_plan->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="control-label">Name<span class="tx-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name" value="{{ $subscription_plan?->name }}" required="">
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description<span class="tx-danger">*</span></label>
                        <textarea class="form-control" id="description" style="height: 100px; overflow-y: auto;" name="description" placeholder="Enter Description" required="">{{ $subscription_plan?->description }}</textarea>
                    </div>
                   
                    <div class="form-group">
                        <label for="name" class="control-label">Email Price<span class="tx-danger">*</span></label>
                        <input type="number" class="form-control" id="email_price" name="email_price"
                            placeholder="Enter Email Price" value="{{ $subscription_plan?->email_price }}"
                            required="">
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Post Price<span class="tx-danger">*</span></label>
                        <input type="number" class="form-control" id="post_price" name="post_price"
                            placeholder="Enter Post Price" value="{{ $subscription_plan?->post_price }}" required="">
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

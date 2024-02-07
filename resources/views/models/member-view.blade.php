<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Member Info 
                    <span class="fw-bold">
                        (Applied on : {{$member?->created_at->format('d-M-Y')}})
                    </span> 
                    @if ($member?->approved_at)
                    <span class="fw-bold text-success">
                        (Approved on : {{$member?->approved_at->format('d-M-Y')}})
                    </span> 
                        @endif
                </h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row g-0">
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-User">User Name</span>
                        <input type="text" class="form-control" placeholder="User Name" value="{{$member?->username}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-Email">Email</span>
                        <input type="text" class="form-control" placeholder="Email" value="{{$member?->email}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-Given">Title</span>
                        <input type="text" class="form-control" placeholder="Title" value="{{$member?->title}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-Given">Given Name</span>
                        <input type="text" class="form-control" placeholder="Given Name" value="{{$member?->given_name}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-Family">Family Name</span>
                        <input type="text" class="form-control" placeholder="Family Name" value="{{$member?->family_name}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-preferred_name">Preferred Name</span>
                        <input type="text" class="form-control" placeholder="preferred_name" value="{{$member?->preferred_name}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-date_of_birth">Date of Birth</span>
                        <input type="text" class="form-control" placeholder="date_of_birth" value="{{$member?->date_of_birth}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-number_street">Street Number</span>
                        <input type="text" class="form-control" placeholder="number_street" value="{{$member?->number_street}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-suburb">Suburb</span>
                        <input type="text" class="form-control" placeholder="suburb" value="{{$member?->suburb}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-state">State</span>
                        <input type="text" class="form-control" placeholder="state" value="{{$member?->state}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-country">Country</span>
                        <input type="text" class="form-control" placeholder="country" value="{{$member?->country}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-post_code">Post Code</span>
                        <input type="text" class="form-control" placeholder="post_code" value="{{$member?->post_code}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-phone">Phone</span>
                        <input type="text" class="form-control" placeholder="phone" value="{{$member?->phone}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-mobile">Mobile</span>
                        <input type="text" class="form-control" placeholder="mobile" value="{{$member?->mobile}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-delivery">Delivery</span>
                        <input type="text" class="form-control" placeholder="delivery" value="{{$member?->delivery}}"  readonly>
                    </div>
                    <div class="input-group mb-3 px-1 col-6">
                        <span class="input-group-text" id="basic-gender">Gender</span>
                        <input type="text" class="form-control" placeholder="gender" value="{{$member?->gender}}"  readonly>
                    </div>
                </div>
                <div class="modal-footer p-1">
                    <button class="btn btn-default close-modal">Close</button>
                    @if (!$member?->approved_at)
                        <form id="curdForm" name="curdForm" class="form-horizontal" method="POST" action="{{ route('members.update',['member'=>$member?->id]) }}">
                            @csrf
                            @method("PUT")
                        <button class="btn btn-success close-modal">Approve</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
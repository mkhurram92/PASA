<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Update Sibling</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="curdForm" name="curdForm" class="form-horizontal" method="POST" action="{{ route('editJuniorSibling',['sibling'=>$sibling?->id]) }}">
                    @csrf
                    @method("PATCH")
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" class="form-control" name="given_name" value="{{$sibling?->given_name}}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="name" class="control-label">Gender</label>
                            <select class="form-control" name="gender" id="gender">
                                @forelse($genders as $gender)
                                    <option value="{{ $gender->id }}" @if($sibling?->gender==$gender->id) selected @endif>{{ ucwords($gender->name) }}</option>
                                @empty
                                    <option value="">Select option</option>
                                @endforelse
                            </select>
                        </div>
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

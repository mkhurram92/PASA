<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Update City</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="curdForm" name="curdForm" class="form-horizontal" method="POST" action="{{ route('cities.update',['city'=>$city?->id]) }}">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Of City" value="{{$city?->name}}" >
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">State / County</label>
                        <select class="form-control select2" id="counties_select2" name="county_id">
                            <option value="{{ $city?->county?->id }}" selected>{{ $city?->county?->name }}</option>
                        </select>
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

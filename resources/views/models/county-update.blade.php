<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Update County</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="curdForm" name="curdForm" class="form-horizontal" method="POST" action="{{ route('counties.update',['county'=>$county?->id]) }}">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Name Of County" value="{{$county?->name}}" >
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Country</label>
                        <select class="form-control select2" id="countries_select2" name="country_id">
                            <option value="{{ $county?->Country?->id }}" selected>{{ $county?->Country?->name }}</option>
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

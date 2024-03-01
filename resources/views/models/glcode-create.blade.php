<div class="modal fade" id="crudModal" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Create a Sub G/L</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="crudForm" name="crudForm" class="form-horizontal" action="{{ route('gl-codes.store') }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="subNameView" class="control-label">Sub G/L</label>
                        <input type="text" class="form-control" id="sub_gl_name" name="sub_gl_name" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="parent_id">Parent G/L</label>
                        <select id="parent_id" name="parent_id" data-placeholder="Select Parent G/L" class="form-select">
                            <option value=""></option>
                            @foreach ($parentGlCodes as $glCode)
                                <option value="{{ $glCode->id }}">{{ $glCode->name }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="subNameView" class="control-label">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description" rows="4"></textarea>
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

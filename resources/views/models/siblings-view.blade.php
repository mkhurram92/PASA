<div class="modal fade" id="crudModel" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Show Siblings</h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @forelse ($siblings as $sibling)
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="name" class="control-label">Gender</label>
                                    <input type="text" class="form-control"
                                        value="{{ Str::ucfirst($sibling?->withGender->name) }}" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" class="form-control" value="{{ $sibling?->given_name }}"
                                        readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="name" class="control-label">Date of Birth</label>
                                    <input type="dob" class="form-control" value="{{ $sibling?->date_of_birth }}"
                                        readonly>
                                </div>
                                {{-- <div class="col-md-3 form-group d-flex align-items-end justify-content-center">
                                    <a href="{{ route('editJuniorSibling', ['sibling' => $sibling?->id]) }}"
                                        class="btn btn-primary edit-sibling">Edit</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-default close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="editSiblingModal"></div>
<script>
    $(document).on("click", ".edit-sibling", function(e) {
        e.preventDefault();
        $.ajax($(e.target).attr("href"), {
                type: "GET"
            })
            .done(res => {
                if (res?.html) {
                    $("#editSiblingModal").html(res?.html)
                    $("#editSiblingModal").find(".modal:not(.show)").modal("show");
                }
            })
    })
</script>

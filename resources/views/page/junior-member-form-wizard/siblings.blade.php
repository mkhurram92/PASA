<h3>Account</h3>
<section>
    <div class="row" id="sibling_clone">
        <div class="col-md-12 d-flex justify-content-between">
            <h3>Sibling Details</h3>
            <button class="btn btn-primary" id="addSibling">Add Sibling</button>
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Sibling 1 Name: <span class="tx-danger">*</span></label>
            <input class="form-control" id="sibling_1_name" name="sibling[name][]" value=""
                placeholder="Enter sibling name" required="" type="text">
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Gender: <span class="tx-danger">*</span></label>
            <select name="sibling[gender][]" class="form-control form-select select2" id="gender1">
                @forelse ($genders as $gender)
                    <option value="{{ $gender->id }}">{{ Str::ucfirst($gender->name) }}</option>
                @empty
                    <option value="">Select option</option>
                @endforelse
            </select>
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Date of Birth:</label>
            <input class="form-control" id="date_of_birth" name="sibling[date_of_birth][]"
                value="{{ old('date_of_birth') }}" placeholder="Enter Date of Birth" required="" type="date">
        </div>
    </div>
</section>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        let count = 1;
        $(document).on("click", "#addSibling", e => {
            let html = $("#clone").html();
            html = html.replaceAll("{count}", count += 1);
            $("#sibling_clone").append(html);
        })
    })
</script>

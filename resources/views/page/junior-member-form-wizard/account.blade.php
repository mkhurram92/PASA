<h3>Account</h3>
<section>
    <div class="row">
        <h3>Junior Application Personal Details</h3>
        <div class="col-md-6 my-2">
            <label class="form-control-label">Given name: <span class="tx-danger">*</span></label>
            <input class="form-control" id="given_name" name="given_name" value="{{ old("given_name") }}" placeholder="Enter given name" required="" type="text">
        </div>
        <div class="col-md-6 my-2">
            <label class="form-control-label">Family Name: <span class="tx-danger">*</span></label>
            <input class="form-control" id="family_name" name="family_name" value="{{ old("family_name") }}" placeholder="Enter Family name" required="" type="text">
        </div>
        <div class="col-md-6 my-2">
            <label class="form-control-label">Preferred Name: <span class="tx-danger">*</span></label>
            <input class="form-control" id="preferred_name" name="preferred_name" value="{{ old("preferred_name") }}" placeholder="Enter Preferred Name" required="" type="text">
        </div>
        <div class="col-md-6 my-2">
            <label class="form-control-label">Date of Birth:</label>
            <input class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old("date_of_birth") }}" placeholder="Enter Date of Birth" required="" type="date">
        </div>
        <div class="col-md-6 my-2">
            <label class="form-control-label">Gender: <span class="tx-danger">*</span></label>
            <select name="gender" class="form-control form-select select2" id="gender">
                @forelse ($genders as $gender)
                <option value="{{ $gender->id }}">{{ ucwords($gender->name) }}</option>
                @empty
                <option value="">Select option</option>
                @endforelse
            </select>
        </div>

    </div>
</section>
<script>
    window.addEventListener("DOMContentLoaded", function() {

    })
</script>

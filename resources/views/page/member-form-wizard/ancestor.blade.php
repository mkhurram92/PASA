<section>
    <div class="row">
        <h3 class="card-title">Primary Ancestor</h3>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Gender</label>
            <select name="gender" class="form-control form-select select2" id="gender_ancestor">
                @forelse ($genders as $gender)
                    <option value="{{ $gender->id }}">{{ ucwords($gender->name) }}</option>
                @empty
                    <option value="">Select Option</option>
                @endforelse
            </select>
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Full Name<span class="tx-danger">*</span></label>
            <input class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}"
                placeholder="Enter Full name" required="" type="text">
        </div>
        <div class="col-md-4 my-2" id="maiden_name_container" style="display: none">
            <label class="form-control-label">Maiden Name<span class="tx-danger">*</span></label>
            <input class="form-control" id="maiden_name" name="maiden_name" value="{{ old('maiden_name') }}"
                placeholder="Enter Maiden Name" required="" type="text">
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Place Of Origin</label>
            <input class="form-control" id="place_of_origin" name="place_of_origin" value="{{ old('place_of_origin') }}"
                placeholder="Enter Place Of Origin" required="" type="text">
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Arrival Place in SA<span class="tx-danger">*</span></label>
            <select name="place_of_arrival" class="form-control form-select select2" id="place_of_arrival">
                @forelse ($ports as $port)
                    <option value="{{ $port?->id }}">{{ $port?->name ?? 'N/A' }}</option>
                @empty
                    <option value="">Select option</option>
                @endforelse
            </select>
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Ship Name<span class="tx-danger">*</span></label>
            <select name="name_of_the_ship" class="form-control form-select select2" id="name_of_the_ship">
                @forelse ($voyages as $voyage)
                    <option value="{{ $voyage?->id }}">{{ $voyage?->ship?->name_of_ship . '-' . $voyage?->year }}
                    </option>
                @empty
                    <option value="">Select option</option>
                @endforelse
            </select>
        </div>
    </div>
</section>

<script>
    window.addEventListener("DOMContentLoaded", function() {
        jQuery(document).on("change", "#gender", function(e) {
            $("#maiden_name_container").hide();
            if (e.target.value == "female") {
                $("#maiden_name_container").show();
            }
        })
    })
</script>

<h3>Account</h3>
<section>
    <div class="row">
        <h3 class="card-title"> Account Information</h3>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Username <span class="tx-danger">*</span></label>
            <input class="form-control" id="username" name="username" value="{{ old('username') }}"
                 required="" type="text">
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Email <span class="tx-danger">*</span></label>
            <input class="form-control" id="email" name="email" value="{{ old('email') }}"
                 required="" type="text">
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Confirmation Email <span class="tx-danger">*</span></label>
            <input class="form-control" id="email_confirmation" name="email_confirmation"
                value="{{ old('email_confirmation') }}"  required="" type="email">
        </div>
    </div>
    <br>
    <div class="row">
        <h3 class="card-title">Application Personal Details</h3>
        <div class="col-12">
            <div class="row">
                <div class="col-md-2 my-2">
                    <label class="form-control-label">Gender <span class="tx-danger">*</span></label>
                    <select name="gender" class="form-control form-select select2" id="gender">
                        @forelse ($genders as $gender)
                            <option value="{{ $gender->id }}">{{ ucwords($gender->name) }}</option>
                        @empty
                            <option value="">Select option</option>
                        @endforelse
                    </select>
                </div>
                <div class="col-md-2 my-2">
                    <label class="form-control-label">Title <span class="tx-danger">*</span></label>
                    <select name="title" class="form-control form-select select2" id="title">
                        @forelse ($titles as $title)
                            <option value="{{ $title?->id }}">
                                {{ $title?->name }}</option>
                        @empty
                            <option value="">Select Title</option>
                        @endforelse
                    </select>
                </div>
                <div class="col-md-4 my-2">
                    <label class="form-control-label">Given name <span class="tx-danger">*</span></label>
                    <input class="form-control" id="given_name" name="given_name" value="{{ old('given_name') }}"
                         required="" type="text">
                </div>
                <div class="col-md-4 my-2">
                    <label class="form-control-label">Family Name <span class="tx-danger">*</span></label>
                    <input class="form-control" id="family_name" name="family_name" value="{{ old('family_name') }}"
                         required="" type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Preferred Name <span class="tx-danger">*</span></label>
                    <input class="form-control" id="preferred_name" name="preferred_name"
                        value="{{ old('preferred_name') }}"  required=""
                        type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Birth Date <span class="tx-danger">*</span></label>
                    <input class="form-control" id="date_of_birth" name="date_of_birth"
                        value="{{ old('date_of_birth') }}"  required=""
                        type="date">
                </div>

                <div class="col-md-12 my-2">
                    <label class="form-control-label">Unit No / Number & Street <span class="tx-danger">*</span></label>
                    <input class="form-control" id="number_street" name="number_street"
                        value="{{ old('number_street') }}"  required=""
                        type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Suburb <span class="tx-danger">*</span></label>
                    <input class="form-control" id="suburb" name="suburb" value="{{ old('suburb') }}"
                         required="" type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">State <span class="tx-danger">*</span></label>
                    <select name="state" class="form-control form-select select2" id="state">
                        @forelse ($states as $state)
                            <option value="{{ $state?->id }}">{{ $state?->name }}</option>
                        @empty
                            <option value="">Select state</option>
                        @endforelse
                    </select>
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Country <span class="tx-danger">*</span></label>
                    <select name="country" class="form-control form-select select2" id="country">
                        <option value="Australia">Australia</option>
                    </select>
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Post Code/Zip <span class="tx-danger">*</span></label>
                    <input class="form-control" id="post_code" name="post_code" value="{{ old('post_code') }}"
                         required="" type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Phone (Home) </label>
                    <input class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                         required="" type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Phone (Mobile) </label>
                    <input class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}"
                         required="" type="text">
                </div>
            </div>
        </div>
    </div>
</section>

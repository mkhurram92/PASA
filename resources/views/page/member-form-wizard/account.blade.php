<h3>Account</h3>
<section>
    <div class="row">
        <h3 class="card-title"> Account Information</h3>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Username</label>
            <input class="form-control getValid" id="username" name="username" value="{{ old('username') }}" type="text">
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Email</label>
            <input class="form-control getValid" id="email" name="email" value="{{ old('email') }}"  type="text">
        </div>
        <div class="col-md-4 my-2">
            <label class="form-control-label">Confirmation Email</label>
            <input class="form-control getValid" id="email_confirmation" name="email_confirmation" value="{{ old('email_confirmation') }}" type="email">
        </div>
    </div>
    <br>
    <div class="row">
        <h3 class="card-title"> Application Personal Details</h3>
        <div class="col-12">
            <div class="row">
                <div class="col-md-2 my-2">
                    <label class="form-control-label">Gender</label>
                    <select name="gender" class="form-control form-select select2" id="gender">
                        @forelse ($genders as $gender)
                        <option value="{{ $gender->id }}">{{ ucwords($gender->name) }}</option>
                        @empty
                        <option value="">Select option</option>
                        @endforelse
                    </select>
                </div>
                <div class="col-md-2 my-2">
                    <label class="form-control-label">Title</label>
                    <select name="title" class="form-control form-select select2 getValid" id="title">
                        @forelse ($titles as $title)
                        <option value="{{ $title?->id }}">
                            {{ $title?->name }}
                        </option>
                        @empty
                        <option value="">Select Title</option>
                        @endforelse
                    </select>
                </div>
                <div class="col-md-4 my-2">
                    <label class="form-control-label">Given name</label>
                    <input class="form-control" id="given_name" name="given_name" value="{{ old('given_name') }}" type="text">
                </div>
                <div class="col-md-4 my-2">
                    <label class="form-control-label">Family Name</label>
                    <input class="form-control" id="family_name" name="family_name" value="{{ old('family_name') }}" type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Preferred Name</span></label>
                    <input class="form-control" id="preferred_name" name="preferred_name" value="{{ old('preferred_name') }}" type="text">
                </div>
                <div class="col-md-6 my-2">
                    <div class="row d-flex">
                        <div class="col-md-4 my-2">
                            <label class="form-control-label">Birth Year </label>
                            <input class="form-control getValid" id="year_of_birth" name="year_of_birth" value="{{ old('year_of_birth') }}" type="text" pattern="\d{4}" maxlength="4" title="Enter a 4-digit year" placeholder="YYYY">
                        </div>
                        <div class="col-md-4 my-2">
                            <label class="form-control-label">Birth Month</label>
                            <input class="form-control getValid" id="month_of_birth" name="month_of_birth" value="{{ old('month_of_birth') }}" type="text" pattern="\d{2}" maxlength="4" title="Enter a 2-digit month" placeholder="MM">
                        </div>
                        <div class="col-md-4 my-2">
                            <label class="form-control-label">Birth Date</label>
                            <input class="form-control getValid" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" type="text" pattern="\d{2}" maxlength="4" title="Enter a 2-digit date" placeholder="DD">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 my-2">
                    <label class="form-control-label">Unit No. / Number & Street </label>
                    <input class="form-control" id="number_street" name="number_street" value="{{ old('number_street') }}" type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Suburb</label>
                    <input class="form-control" id="suburb" name="suburb" value="{{ old('suburb') }}" type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">State</label>
                    <select name="state" class="form-control form-select select2" id="state">
                        @forelse ($states as $state)
                        <option value="{{ $state?->id }}">{{ $state?->name }}</option>
                        @empty
                        <option value="">Select state</option>
                        @endforelse
                    </select>
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Country <span class="tx-danger"></span></label>
                    <select name="country" class="form-control form-select select2" id="country">
                        <option value="Australia">Australia</option>
                    </select>
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Post Code/Zip <span class="tx-danger"></span></label>
                    <input class="form-control" id="post_code" name="post_code" value="{{ old('post_code') }}" type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Phone (Home) </label>
                    <input class="form-control" id="phone" name="phone" value="{{ old('phone') }}" type="text">
                </div>
                <div class="col-md-6 my-2">
                    <label class="form-control-label">Phone (Mobile) </label>
                    <input class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" type="text">
                </div>
            </div>
        </div>
    </div>
</section>
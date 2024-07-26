<h3>Pedigree</h3>
<section class='container'>
    <div class="row mb-3">
        <div class="col-sm-6 d-flex align-items-center">
            <label class="form-label mb-0 me-2">Applicant's Father - This is the Pioneer line</label>
            <input id="father_1" type="radio" class="radio-input" name="pioneer_parents" value="0">
        </div>
        <div class="col-sm-6 d-flex align-items-center">
            <label class="form-label mb-0 me-2">This is my Pioneer</label>
            <input id="fatherpioneer_1" type="radio" class="radio-input ancestor_father" name="ancestor">
        </div>
    </div>

    <div class="row mb-3 element" id='div_2'>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2">
                    <label class="form-control-label">Father Name</label>
                    <input id="father_name_1" type="text" class="form-control" name="main_father_name">
                </div>
                <div class="col-md-2">
                    <label class="form-control-label">Birth Date</label>
                    <input id="father_dob_1" type="date" class="form-control" name="main_father_dob">
                </div>
                <div class="col-md-2">
                    <label class="form-control-label">Birth Place</label>
                    <input id="main_father_pob" type="text" class="form-control" name="main_father_pob">
                </div>
                <div class="col-md-2">
                    <label class="form-control-label">Death Date</label>
                    <input id="father_dod_1" type="date" class="form-control" name="main_father_dod">
                </div>
                <div class="col-md-2">
                    <label class="form-control-label">Death Place</label>
                    <input id="main_father_pod" type="text" class="form-control" name="main_father_pod">
                </div>
                <div class="col-md-2">
                    <label class="form-control-label">Marriage Date</label>
                    <input id="main_father_dom" type="date" class="form-control" name="main_father_dom">
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-6 d-flex align-items-center">
            <label class="form-label mb-0 me-2">Applicant's Mother - This is the Pioneer line</label>
            <input id="mother" type="radio" class="radio-input" name="pioneer_parents" value="0">
        </div>
        <div class="col-sm-6 d-flex align-items-center">
            <label class="form-label mb-0 me-2">This is my Pioneer</label>
            <input id="motherpioneer_1" type="radio" class="radio-input ancestor_mother" name="ancestor">
        </div>
    </div>

    <div class="row mb-3 element" id='div_2'>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2">
                    <label class="form-control-label">Mother Name</label>
                    <input id="mother_name_1" type="text" class="form-control" name="main_mother_name">
                </div>
                <div class="col-md-2">
                    <label class="form-control-label">Birth Date</label>
                    <input id="mother_dob_1" type="date" class="form-control" name="main_mother_dob">
                </div>
                <div class="col-md-2">
                    <label class="form-control-label">Birth Place</label>
                    <input id="main_mother_pob" type="text" class="form-control" name="main_mother_pob">
                </div>
                <div class="col-md-2">
                    <label class="form-control-label">Death Date</label>
                    <input id="mother_dod_1" type="date" class="form-control" name="main_mother_dod">
                </div>
                <div class="col-md-2">
                    <label class="form-control-label">Death Place</label>
                    <input id="main_mother_pod" type="text" class="form-control" name="main_mother_pod">
                </div>
                <div class="col-md-2">
                    <label class="form-control-label">Marriage Place</label>
                    <input id="main_father_pom" type="text" class="form-control" name="main_father_pom">
                </div>
                <div class="col-md-1 remove-button">
                    <button type="button" class="btn btn-danger" onclick="removePedigreeForm(this)">Remove</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-3">
            <div class="mb-3 mb-sm-0">
                <label class="form-label">&nbsp;</label>
                <div class="input-group">
                    <button type="button" class="btn btn-primary add123">Add the Preceding Generation</button>
                </div>
            </div>
        </div>
    </div>
</section>

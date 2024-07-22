<h3>Pedigree</h3>
<section class='container'>
    <div class="row element mb-3" id='div_1'>
        <div class="col-sm-6">
            <div class="mb-3 mb-sm-0 d-flex align-items-center">
                <label class="form-label mb-0 me-2">Applicant's Father - This is the Pioneer line</label>
                <input name="pioneer_parents" id="father_1" class="radio-input" type="radio" value="1" />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3 mb-sm-0 d-flex align-items-center">
                <label class="form-label mb-0 me-2">Applicant's Mother - This is the Pioneer line</label>
                <input id="mother" type="radio" class="radio-input" name="pioneer_parents" value="0">
            </div>
        </div>
    </div>
    <div class="row element mb-3" id='div_2'>
        <div class="col-sm-3">
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Father Name</label>
                <div class="input-group">
                    <input id="father_name_1" type="text" class="form-control" name="main_father_name">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Birth Date</label>
                <div class="input-group">
                    <input id="father_dob_1" type="date" class="form-control me-3" name="main_father_dob">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Birth Place</label>
                <div class="input-group">
                    <input id="main_father_pob" type="text" class="form-control" name="main_father_pob">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Death Date</label>
                <div class="input-group">
                    <input id="father_dod_1" type="date" class="form-control me-3" name="main_father_dod">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Death Place</label>
                <div class="input-group">
                    <input id="main_father_pod" type="text" class="form-control" name="main_father_pod">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3 mb-sm-0 d-flex align-items-center">
                <label class="form-label mb-0 me-2">This is my Pioneer </label>
                <input id="fatherpioneer_1" type="radio" class="radio-input ancestor_father" name="ancestor">
            </div>
            <br>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Marriage Date</label>
                <div class="input-group">
                    <input id="main_father_dom" type="date" class="form-control me-3" name="main_father_dom">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Marriage Place</label>
                <div class="input-group">
                    <input id="main_father_pom" type="text" class="form-control" name="main_father_pom">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Mother Name</label>
                <div class="input-group">
                    <input id="mother_name_1" type="text" class="form-control" name="main_mother_name">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Birth Date</label>
                <div class="input-group">
                    <input id="mother_dob_1" type="date" class="form-control me-3" name="main_mother_dob">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Birth Place</label>
                <div class="input-group">
                    <input id="main_mother_pob" type="text" class="form-control" name="main_mother_pob">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Death Date</label>
                <div class="input-group">
                    <input id="mother_dod_1" type="date" class="form-control me-3" name="main_mother_dod">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Death Place</label>
                <div class="input-group">
                    <input id="main_mother_pod" type="text" class="form-control" name="main_mother_pod">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3 mb-sm-0 d-flex align-items-center">
                <label class="form-label mb-0 me-2">This is my Pioneer </label>
                <input id="motherpioneer_1" type="radio" class="radio-input ancestor_mother" name="ancestor">
            </div>
            <br>
        </div>
    </div>
    <div class="row element mb-3" id='div_2'>
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
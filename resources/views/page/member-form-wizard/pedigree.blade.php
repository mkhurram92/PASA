<h3>Pedigree</h3>
<section class='container'>
    <div class="row element mb-3" id='div_1'>
        <div class="col-sm-6">
            <div class="mb-3 mb-sm-0 d-flex align-items-center">
                <label class="form-label mb-0 me-2">Applicant's Father - this is the pioneer Line</label>
                <input name="pioneer_parents" id="father_1" class="radio-input" type="radio" value="1" />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3 mb-sm-0 d-flex align-items-center">
                <label class="form-label mb-0 me-2">Applicant's Mother - this is the pioneer Line</label>
                <input id="mother" type="radio" class="radio-input" name="pioneer_parents" value="0">
            </div>
        </div>
    </div>
    <div class="row element mb-3" id='div_2'>
        <div class="col-sm-3">
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Father Name</label>
                <div class="input-group">
                    <input id="father_name_1" type="text" class="form-control" placeholder="Father's Full Name"
                        name="main_father_name">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Date of Birth</label>
                <div class="input-group">
                    <input id="father_dob_1" type="date" class="form-control me-3" placeholder="Date of Birth"
                        name="main_father_dob">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Place of Birth</label>
                <div class="input-group">
                    <input id="main_father_pob" type="text" class="form-control" placeholder="Place of Birth"
                        name="main_father_pob">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Date of Death</label>
                <div class="input-group">
                    <input id="father_dod_1" type="date" class="form-control me-3" placeholder="Date of Death"
                        name="main_father_dod">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Place of Death</label>
                <div class="input-group">
                    <input id="main_father_pod" type="text" class="form-control" placeholder="Place of Death"
                        name="main_father_pod">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3 mb-sm-0 d-flex align-items-center">
                <label class="form-label mb-0 me-2">This is my pioneer</label>
                <input id="fatherpioneer_1" type="radio" class="radio-input ancestor_father" name="ancestor">
            </div>
            <br>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Date of Marriage</label>
                <div class="input-group">
                    <input id="main_father_dom" type="date" class="form-control me-3" placeholder="Date of Marriage"
                        name="main_father_dom">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Place of Marriage</label>
                <div class="input-group">
                    <input id="main_father_pom" type="text" class="form-control" placeholder="Place of Marriage"
                        name="main_father_pom">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Mother Name</label>
                <div class="input-group">
                    <input id="mother_name_1" type="text" class="form-control" placeholder="Mother's Full Name"
                        name="main_mother_name">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Date of Birth</label>
                <div class="input-group">
                    <input id="mother_dob_1" type="date" class="form-control me-3" placeholder="Date of Birth"
                        name="main_mother_dob">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Place of Birth</label>
                <div class="input-group">
                    <input id="main_mother_pob" type="text" class="form-control" placeholder="Place of Birth"
                        name="main_mother_pob">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Date of Death</label>
                <div class="input-group">
                    <input id="mother_dod_1" type="date" class="form-control me-3" placeholder="Date of Death"
                        name="main_mother_dod">
                </div>
            </div>
            <div class="mb-2 mb-sm-0">
                <label class="form-label">Place of Death</label>
                <div class="input-group">
                    <input id="main_mother_pod" type="text" class="form-control" placeholder="Place of Death"
                        name="main_mother_pod">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="mb-3 mb-sm-0 d-flex align-items-center">
                <label class="form-label mb-0 me-2">This is my pioneer</label>
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
                    <button type="button" class="btn btn-primary add123">Add the preceding generation</button>
                </div>
            </div>
        </div>
    </div>
</section>

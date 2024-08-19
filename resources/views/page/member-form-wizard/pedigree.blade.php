<h3>Pedigree</h3>
<section>
    <div class="row">
        <div class="row mb-3">
            <h3 class="card-title"> Pedigree Chart</h3>
            <div class="col-sm-6 d-flex align-items-center">
                <label class="form-label mb-0 me-2">Applicant's Father - This is the Pioneer line</label>
                <input id="father_1" type="radio" class="radio-input" name="pioneer_parents" value="0">
            </div>
            <div class="col-sm-6 d-flex align-items-center">
                <label class="form-label mb-0 me-2">This is my Pioneer</label>
                <input id="fatherpioneer_1" type="radio" class="radio-input ancestor_father" name="ancestor">
            </div>
        </div>
        <div id="pedigree-forms">
            <!-- Initial form -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <a class="form-control-label" style="color: #022ff8; font-size:16px">Generation x <span
                                class="pedigree-level">1</span></a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-control-label">Father Name</label>
                        <input class="form-control" name="pedigrees[0][f_name]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Birth Date</label>
                        <input class="form-control" name="pedigrees[0][date_of_birth]" placeholder="YYYY-MM-DD"
                            type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Birth Place</label>
                        <input class="form-control" name="pedigrees[0][place_of_birth]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Death Date</label>
                        <input class="form-control" name="pedigrees[0][date_of_death]" placeholder="YYYY-MM-DD"
                            type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Death Place</label>
                        <input class="form-control" name="pedigrees[0][place_of_death]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Marriage Date</label>
                        <input class="form-control" name="pedigrees[0][date_of_marriage]" placeholder="YYYY-MM-DD"
                            type="text">
                    </div>
                </div>
                <div class="row mb-3">
                    <h3 class="card-title"> Pedigree Chart</h3>
                    <div class="col-sm-6 d-flex align-items-center">
                        <label class="form-label mb-0 me-2">Applicant's Mother - This is the Pioneer line</label>
                        <input id="mother" type="radio" class="radio-input" name="pioneer_parents" value="0">
                    </div>
                    <div class="col-sm-6 d-flex align-items-center">
                        <label class="form-label mb-0 me-2">This is my Pioneer</label>
                        <input id="motherpioneer_1" type="radio" class="radio-input ancestor_mother" name="ancestor">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-control-label">Mother Name</label>
                        <input class="form-control" name="pedigrees[0][m_name]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Birth Date</label>
                        <input class="form-control" name="pedigrees[0][m_birth_date]" placeholder="YYYY-MM-DD"
                            type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Birth Place</label>
                        <input class="form-control" name="pedigrees[0][m_birth_place]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Death Date</label>
                        <input class="form-control" name="pedigrees[0][m_death_date]" placeholder="YYYY-MM-DD"
                            type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Death Place</label>
                        <input class="form-control" name="pedigrees[0][m_death_place]" type="text">
                    </div>
                    <div class="col-md-2">
                        <label class="form-control-label">Marriage Place</label>
                        <input class="form-control" name="pedigrees[0][place_of_marriage]" type="text">
                    </div>
                    <div class="col-md-12">
                        <label class="form-control-label">Additional Notes</label>
                        <textarea class="form-control" rows="4" name="pedigrees[0][notes]"></textarea>
                    </div>
                    <br>
                    <div class="col-md-1 remove-button">
                        <button type="button" class="btn btn-danger"
                            onclick="removePedigreeForm(this)">Remove</button>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" onclick="addPedigreeForm()">Add Another Pedigree</button>
        </div>
    </div>
</section>
<script>
    let pedigreeIndex = 1;

    function addPedigreeForm() {
        const newForm = `
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <a class="form-control-label" style="color: #022ff8; font-size:16px">Generation x <span class="pedigree-level">${pedigreeIndex + 1}</span></a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label class="form-control-label">Father Name</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][f_name]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Birth Date</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][date_of_birth]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Birth Place</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][place_of_birth]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Death Date</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][date_of_death]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Death Place</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][place_of_death]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Marriage Date</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][date_of_marriage]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Mother Name</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][m_name]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Birth Date</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][m_birth_date]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Birth Place</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][m_birth_place]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Death Date</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][m_death_date]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Death Place</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][m_death_place]" type="text">
                        </div>
                        <div class="col-md-2">
                            <label class="form-control-label">Marriage Place</label>
                            <input class="form-control" name="pedigrees[${pedigreeIndex}][place_of_marriage]" type="text">
                        </div>
                        <div class="col-md-12">
                            <label class="form-control-label">Additional Notes</label>
                            <textarea class="form-control" rows="3" name="pedigrees[${pedigreeIndex}][notes]"></textarea>
                        </div>
                        <div class="col-md-1 remove-button">
                            <button type="button" class="btn btn-danger" onclick="removePedigreeForm(this)">Remove</button>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            `;
        document.getElementById('pedigree-forms').insertAdjacentHTML('beforeend', newForm);
        pedigreeIndex++;
    }

    function removePedigreeForm(button) {
        button.closest('.card-body').remove();
    }
</script>

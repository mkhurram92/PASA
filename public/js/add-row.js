$(document).ready(function () {

    function isLastElement(element) {
        return element.next().length === 0;
    }

    // Add new element
    $('.container').on('click', '.add123', function () {
        // Finding total number of elements added
        var total_element = $(".element").length;

        // Last <div> with element class id
        var lastid = $(".element:last").attr("id");
        var split_id = lastid.split("_");
        var nextindex = Number(split_id[1]) + 1;

        var f_name = $('#father_name_' + split_id[1]).val();
        var m_name = $('#mother_name_' + split_id[1]).val();
        var full_name = $('#full_name_' + split_id[1]).val();

        if (f_name === '' || m_name === '' || full_name === '') {
            alert("Enter Father or Mother name");
            $("#remove_" + nextindex).hide();
        } else {
            var max = 10;
            // Check total number elements
            if (total_element < max) {
                var htmlString = `
                    <div class='row mb-3' id='div_${nextindex}'>
                        <div class='col-sm-6 d-flex align-items-center'>
                            <label class='form-label mb-0 me-2'>Fathers - This is the Pioneer line</label>
                            <input name='pioneer_sub_parents[${split_id[1] - 2}]' id='father_${nextindex}' class='radio-input' type='radio' value='1' />
                        </div>
                        <div class='col-sm-6 d-flex align-items-center'>
                            <label class='form-label mb-0 me-2'>This is my Pioneer </label>
                            <input id='fatherpioneer_${nextindex}' type='radio' class='radio-input ancestor_father' name='ancestor'>
                        </div>
                    </div>
                    <div class='card-body'>
                        <div class='row mb-3'>
                                <div class='col-md-2'>
                                    <label class='form-label'>Father Name</label>
                                    <input id='father_name_${nextindex}' type='text' class='form-control' name='sub_father_name[]'>
                                </div>
                                <div class='col-md-2'>
                                    <label class='form-label'>Birth Date</label>
                                    <input id='father_dob_${nextindex}' type='text' class='form-control' placeholder='YYYY-MM-DD' name='sub_father_dob[]'>
                                </div>
                                <div class='col-md-2'>    
                                    <label class='form-label'>Birth Place</label>
                                    <input id='sub_father_pob_${nextindex}' type='text' class='form-control' name='sub_father_pob[]'>
                                </div>
                                <div class='col-md-2'>
                                    <label class='form-label'>Death Date</label>
                                    <input id='father_dod_${nextindex}' type='text' class='form-control' placeholder='YYYY-MM-DD' name='sub_father_dod[]'>
                                </div>
                                <div class='col-md-2'>    
                                    <label class='form-label'>Death Place</label>
                                    <input id='sub_father_pod_${nextindex}' type='text' class='form-control' name='sub_father_pod[]'>
                                </div>
                                <div class='col-md-2'>  
                                    <label class='form-label'>Marriage Date</label>
                                    <input id='sub_father_dom_${nextindex}' type='text' class='form-control' placeholder='YYYY-MM-DD' name='sub_father_dom[]'>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class='row mb-3'>
                        <div class='col-sm-6 d-flex align-items-center'>
                            <label class='form-label mb-0 me-2'>Mothers - this is the Pioneer line</label>
                            <input id='mother_${nextindex}' type='radio' class='radio-input' name='pioneer_sub_parents[${split_id[1] - 2}]' value='0'>
                        </div>
                        <div class='col-sm-6 d-flex align-items-center'>
                            <label class='form-label ancestor_mother'>This is my Pioneer </label>
                            <input id='motherpioneer_${nextindex}' type='radio' class='radio-input ancestor_mother' name='ancestor'>
                        </div>
                    <div>
                    <div class='card-body'>
                        <div class='row mb-3'>
                            <div class='col-md-2'>
                                <label class='form-label'>Mother Name</label>
                                <input id='mother_name_${nextindex}' type='text' class='form-control' name='sub_mother_name[]'>
                            </div>
                            <div class='col-md-2'>
                                <label class='form-label'>Birth Date</label>
                                <input id='mother_dob_${nextindex}' type='text' class='form-control' placeholder='YYYY-MM-DD' name='sub_mother_dob[]'>
                            </div>
                            <div class='col-md-2'>
                                    <label class='form-label'>Birth Place</label>
                                    <input id='sub_mother_pob_${nextindex}' type='text' class='form-control' name='sub_mother_pob[]'>
                            </div>
                            <div class='col-md-2'>
                                    <label class='form-label'>Death Date</label>
                                    <input id='mother_dod_${nextindex}' type='text' class='form-control' placeholder='YYYY-MM-DD' name='sub_mother_dod[]'>
                            </div>
                            <div class='col-md-2'>
                                    <label class='form-label'>Death Place</label>
                                    <input id='sub_mother_pod_${nextindex}' type='text' class='form-control' name='sub_mother_pod[]'>
                            </div>
                            <div class='col-md-2'>
                                <label class='form-label'>Marriage Place</label>
                                <input id='sub_father_pom_${nextindex}' type='text' class='form-control' name='sub_father_pom[]'>
                            </div>
                        </div>
                    </div>

                        <div class='col-sm-3'>
                            <div class='mb-2 mb-sm-0'>
                                <label class='form-label'>&nbsp;</label>
                                <button id='add_${nextindex}' type='button' class='btn btn-primary add123'>Add the preceding generation</button>
                                <button id='remove_${nextindex}' type='button' class='btn btn-danger remove'>Remove</button>
                            </div>
                        </div>
                    </div>`;

                $(".element:last").after(htmlString);

                $('#father_name_' + split_id[1]).attr('readonly', true);
                $('#mother_name_' + split_id[1]).attr('readonly', true);
                if (split_id[1] > 1) {
                    $('#full_name_' + split_id[1]).attr('readonly', true);
                }
                $(this).attr('disabled', true);
            }
        }

        if (isLastElement($("#div_" + nextindex))) {
            $("#remove_" + nextindex).hide();
        }
    });

    // Handle remove button
    $('.container').on('click', '.remove', function () {
        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];
        $("#div_" + deleteindex).remove();
    });

    // Handle ancestor radio buttons
    $('.container').on('click', '.ancestor_father', function () {
        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];
        $('#full_name').val($('#father_name_' + deleteindex).val());
        $("#ancestor_date_of_birth").val($('#father_dob_' + deleteindex).val());
        $("#ancestor_date_of_death").val($('#father_dod_' + deleteindex).val());
        $('#gender_ancestor').val(1).change();
    });

    $('.container').on('click', '.ancestor_mother', function () {
        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];
        $('#full_name').val($('#mother_name_' + deleteindex).val());
        $("#ancestor_date_of_birth").val($('#mother_dob_' + deleteindex).val());
        $("#ancestor_date_of_death").val($('#mother_dod_' + deleteindex).val());
        $('#gender_ancestor').val(2).change();
    });
});

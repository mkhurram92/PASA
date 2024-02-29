$(document).ready(function () {

    function isLastElement(element) {
        return element.next().length === 0;
    }

    // Add new element
    $('.container').on('click', '.add123', function () {
        // Finding total number of elements added
        var total_element = $(".element").length;

        // last <div> with element class id
        var lastid = $(".element:last").attr("id");
        var split_id = lastid.split("_");
        var nextindex = Number(split_id[1]) + 1;

        var f_name = $('#father_name_' + Number(split_id[1])).val();
        var m_name = $('#mother_name_' + Number(split_id[1])).val();
        var full_name = $('#full_name_' + Number(split_id[1])).val();

        if (f_name == '' || m_name == '' || full_name == '') {
            alert("Enter Father or Mother name");
            $("#remove_" + nextindex).hide();
        } else {
            var max = 10;
            // Check total number elements
            if (total_element < max) {

                $(".element:last").after("<div class='row element mb-3' id='div_" + nextindex + "'></div>");

                var htmlString = '<div class="col-sm-6">';
                htmlString += '<div class="mb-3 mb-sm-0 d-flex align-items-center">';
                htmlString += '<label class="form-label mb-0 me-2">Father - this is the Pioneer line</label>';
                htmlString += '<input name="pioneer_sub_parents[' + Number(split_id[1] - 2) + ']" id="father_' + nextindex + '" class="radio-input" type="radio" value="1" />';
                htmlString += '</div>';
                htmlString += '</div><br><br>'; // Close the first column and start a new one

                htmlString += '<div class="col-sm-6">';
                htmlString += '<div class="mb-3 mb-sm-0 d-flex align-items-center">';
                htmlString += '<label class="form-label mb-0 me-2">Mother - this is the Pioneer line</label>';
                htmlString += '<input id="mother_' + nextindex + '" type="radio" class="radio-input" name="pioneer_sub_parents[' + Number(split_id[1] - 2) + ']" value="0">';
                htmlString += '</div>';
                htmlString += '</div><br><br>'; // Close the second column

                //Father Fields
                htmlString += '<div class="col-sm-3">';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Father Name</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="father_name_' + nextindex + '" type="text" class="form-control" placeholder="Father\'s Full Name" name="sub_father_name[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Birth Date</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="father_dob_' + nextindex + '" type="date" class="form-control" placeholder="Birth Date" name="sub_father_dob[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Birth Place</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="sub_father_pob_' + nextindex + '" type="text" class="form-control" placeholder="Birth Place" name="sub_father_pob[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Death Date</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="father_dod_' + nextindex + '" type="date" class="form-control" placeholder="Death Date" name="sub_father_dod[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Death Place</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="sub_father_pod_' + nextindex + '" type="text" class="form-control" placeholder="Death Place" name="sub_father_pod[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '</div>'; // Close the third column and start a new one

                htmlString += '<div class="col-sm-3">';

                htmlString += '<div class="mb-3 mb-sm-0 d-flex align-items-center">';
                htmlString += '<label class="form-label mb-0 me-2">This is my Pioneer </label>';
                htmlString += '<input id="fatherpioneer_' + nextindex + '" type="radio" class="radio-input ancestor_father" name="ancestor">';
                htmlString += '</div>';
                htmlString += '<br>';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Marriage Date</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="sub_father_dom_' + nextindex + '" type="date" class="form-control" placeholder="Marriage Date" name="sub_father_dom[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Marriage Place</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="sub_father_pom_' + nextindex + '" type="text" class="form-control" placeholder="Marriage Place" name="sub_father_pom[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '</div>';
                // Close the Father Details

                //Mother Fields
                htmlString += '<div class="col-sm-3">';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Mother Name</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="mother_name_' + nextindex + '" type="text" class="form-control" placeholder="Mother\'s Full Name" name="sub_mother_name[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Birth Date</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="mother_dob_' + nextindex + '" type="date" class="form-control" placeholder="Birth Date" name="sub_mother_dob[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Birth Place</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="sub_mother_pob_' + nextindex + '" type="text" class="form-control" placeholder="Birth Place" name="sub_mother_pob[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Death Date</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="mother_dod_' + nextindex + '" type="date" class="form-control" placeholder="Death Date" name="sub_mother_dod[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">Death Place</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<input id="sub_mother_pod_' + nextindex + '" type="text" class="form-control" placeholder="Death Place" name="sub_mother_pod[]">';
                htmlString += '</div>';
                htmlString += '</div>';

                htmlString += '</div>';

                htmlString += '<div class="col-sm-3">';
                htmlString += '<div class="mb-3 mb-sm-0 d-flex align-items-center">';
                htmlString += '<label class="form-label ancestor_mother">This is my Pioneer</label>';
                htmlString += '<input id="motherpioneer_' + nextindex + '" type="radio" class="radio-input ancestor_mother" name="ancestor">';
                htmlString += '</div>';
                htmlString += '<br>';

                htmlString += '</div>';
                // Close Mother Details

                htmlString += '<div class="col-sm-3">';
                htmlString += '<div class="mb-2 mb-sm-0">';
                htmlString += '<label class="form-label">&nbsp;</label>';
                htmlString += '<div class="input-group">';
                htmlString += '<button id="add_' + nextindex + '" type="button" class="btn btn-primary add123">Add the preceding generation</button>';
                htmlString += '</div>';
                htmlString += '<div class="input-group">';
                htmlString += '<button id="remove_' + nextindex + '" type="button" class="btn btn-danger remove">Remove</button>';
                htmlString += '</div>';
                htmlString += '</div>';


                $(".element:last").append(htmlString); // Append the entire HTML string to the last row

                $('#father_name_' + Number(split_id[1])).attr('readonly', true);
                $('#mother_name_' + Number(split_id[1])).attr('readonly', true);
                if (split_id[1] > 1) {
                    $('#full_name_' + Number(split_id[1])).attr('readonly', true);
                }
                $(this).attr('disabled', true);
            }
        }

        if (isLastElement($("#div_" + nextindex))) {
            $("#remove_" + nextindex).hide();
        }

    });

    $('.container').on('click', '.add123', function () {
        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];
        var f_name = $('#father_name_' + Number(split_id[1])).val();
        var m_name = $('#mother_name_' + Number(split_id[1])).val();
        var full_name = $('#full_name_' + Number(split_id[1])).val();
        if (f_name == '' || m_name == '' || full_name == '') {
            $("#remove_" + nextindex).hide();
        }
        $("#remove_" + deleteindex).show();
    });

    // Remove element
    $('.container').on('click', '.remove', function () {
        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];

        // Remove <div> with id
        $("#div_" + deleteindex).remove();
    });

    // Remove element
    $('.container').on('click', '.ancestor_father', function () {
        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];
        var father = $('#father_name_' + deleteindex).val();
        $('#full_name').val(father);

        var dob = $('#father_dob_' + deleteindex).val();
        $("#ancestor_date_of_birth").val(dob);

        var dod = $('#father_dod_' + deleteindex).val();
        $("#ancestor_date_of_death").val(dod);

        $('#gender_ancestor').val(1).change();
    });

    $('.container').on('click', '.ancestor_mother', function () {
        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];
        var mother = $('#mother_name_' + deleteindex).val();
        $('#full_name').val(mother);

        var dob = $('#mother_dob_' + deleteindex).val();
        $("#ancestor_date_of_birth").val(dob);

        var dod = $('#mother_dod_' + deleteindex).val();
        $("#ancestor_date_of_death").val(dod);

        $('#gender_ancestor').val(2).change();
    });
});
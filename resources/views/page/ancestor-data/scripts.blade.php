<script>
    window.addEventListener("DOMContentLoaded", function() {
        if (typeof initShipSelect !== "undefined") {
            initShipSelect();
        }
        if (typeof initPortsSelect !== "undefined") {
            initPortsSelect();
        }
        if (typeof initOccupationSelect !== "undefined") {
            initOccupationSelect();
        }
        if (typeof initModeOfArrivalSelect !== "undefined") {
            initModeOfArrivalSelect();
        }
        if (typeof initSourceOfArrivalSelect !== "undefined") {
            initSourceOfArrivalSelect();
        }
        if (typeof initCountriesSelect !== "undefined") {
            initCountriesSelect();
            initCountriesSelect($("#arrival_countries_select2"));
        }
        // if (typeof initVoyageSelect !== "undefined") {
        // initVoyageSelect();
        // }
        if (typeof initGenderSelect !== "undefined") {
            initGenderSelect();
        }
        if (typeof initStatesSelect !== "undefined") {
            initStatesSelect();
        }
        // $(document).on("change", "#source_of_arrival_select2", function(e) {
        // const id = $(e.target).val();
        // $("#mode_of_arrival_select2").hide();
        // if (id == 1) {
        // $("#mode_of_arrival_select2").show();
        // }else{
        // $("#voyage_select2").val(null).trigger("change");
        // }
        // })
        //$(document).on("change", "#gender_select2", function(e) {
        //    const id = $(e.target).val();
        //    $("#maiden_surname_container").hide();
        //    if (id == 2) {
        //        $("#maiden_surname_container").show();
        //    } else {
        //        $("#maiden_surname").val("");
        //    }
        //})
        $(document).on("change", "#countries_select2", function(e) {
            const id = $(e.target).val();
            if (id) {
                if (typeof initCountiesSelect !== "undefined") {
                    initCountiesSelect();
                }
            }
        })
        $(document).on("change", "#counties_select2", function(e) {
            const id = $(e.target).val();
            if (id) {
                if (typeof initCitiesSelect !== "undefined") {
                    initCitiesSelect();
                }
            }
        })
        $(document).on("change", "#mode_of_arrival_select2", function(e) {
            const id = $(e.target).val();
            if (id) {
                $.ajax("{{ route('get-ship-first-date') }}", {
                        type: "POST",
                        data: {
                            ship_id: id
                        }
                    })
                    .done(response => {
                        // Assuming response includes first_date
                        const firstDate = response.first_date;

                        // Set the first_date in the datepicker
                        $('#first_date').datepicker("setDate", firstDate);

                        // Set the mode_of_arrival_id in a hidden field
                        $("#mode_of_travel_id").val(id); // Use 'id' directly from the select2

                        // Additional code if needed
                        // ...
                    })
                    .fail(error => {
                        console.error("Error fetching ship data:", error);
                    });
            }
        });

        $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'yy-mm-dd',
            changeMonth: true, // Customize the date format as needed
            changeYear: true,
            yearRange: 'c-2000:c+nn'
        });
        $(document).on("input", ".uppercase", function(e) {
            $(e.target).val($(e.target).val().toUpperCase());
        })

    })
</script>

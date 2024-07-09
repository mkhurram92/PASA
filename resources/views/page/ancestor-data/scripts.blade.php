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
                            ship_id: id,
                            _token: '{{ csrf_token() }}' // Add CSRF token for security
                        }
                    })
                    .done(response => {
                        const firstDate = response.first_date;

                        // Display the date in the first_date input field
                        if (firstDate && firstDate !== "Unknown") {
                            $('#first_date').val(firstDate);
                        } else {
                            // Clear the field if the date is "Unknown"
                            $('#first_date').val("");
                        }

                        // Set the mode_of_travel_id in a hidden field
                        $("#mode_of_travel_id").val(id);

                        // Additional code if needed
                        // ...
                    })
                    .fail(error => {
                        console.error("Error fetching ship data:", error);
                    });
            }
        });

        $(document).on("input", ".uppercase", function(e) {
            $(e.target).val($(e.target).val().toUpperCase());
        })

    })
</script>

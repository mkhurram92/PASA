<script>
    window.addEventListener("DOMContentLoaded", function() {
        if (typeof initShipSelect !== "undefined") {
            initShipSelect();
        }
        if (typeof initPortsSelect !== "undefined") {
            initPortsSelect();
        }
        if (typeof initCountriesSelect !== "undefined") {
            initCountriesSelect();
        }
        if (typeof initCountriesSelect !== "undefined") {
            initCountriesSelect();
        }


        // Datepicker
        $('.fc-datepicker').datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
        });


        $(document).on("change", "#daterange-btn", function() {
            initDataTable()
        })
        $(document).on("submit", "#crud form", function() {
            initDataTable()
        })
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

    })

</script>

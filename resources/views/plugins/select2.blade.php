<script>
    
    function initRigSelect2(elem = null) {
        if (!elem) {
            elem = $("#rig");
        }
        if ($(elem).data('select2')) {
            try {
                $(elem).select2("destroy")
            } catch (error) {
                console.warn(error);
            }
        }
        $(elem).select2({
            dropdownParent: elem.parent()
            , ajax: {
                url: 'rig-select2'
                , type: "GET"
                , dataType: 'json'
                , data: function(params) {
                    return {
                        searchTerm: params.term
                        , editId: $('#rig').attr("edit-id")
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };
                }
            }
        });
    }

    function initShipSelect(element = null) {
        if (!element) {
            element = $("#ship_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }

        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('ship.select2')}}"
                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , search: params.term
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };
                }
            }
            , autoWidth: true
        , });
    }

    function initCountiesSelect(element = null) {
        if (!element) {
            element = $("#counties_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }

        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('counties.select2')}}"
                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , country: $("#countries_select2").val()
                        , search: params.term
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };

                }
            }
            , autoWidth: true
        , });
    }

    function initPortsSelect(element = null) {
        if (!element) {
            element = $("#arrived_at_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }

        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('ports.select2')}}"
                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , search: params.term
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };

                }
            }
            , autoWidth: true
        , });
    }

    function initOccupationSelect(element = null) {
        if (!element) {
            element = $("#occupation_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }

        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('occupation.select2')}}"

                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , search: params.term
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };

                }
            }
            , autoWidth: true
        , });
    }

    function initModeOfArrivalSelect(element = null) {
        if (!element) {
            element = $("#mode_of_arrival_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }

        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('mode.of.arrival.select2')}}"
                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , search: params.term
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };

                }
            }
            , autoWidth: true
        , });
    }

    function initSourceOfArrivalSelect(element = null) {
        if (!element) {
            element = $("#source_of_arrival_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }

        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('source.of.arrival.select2')}}"
                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , search: params.term
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };

                }
            }
            , autoWidth: true
        , });
    }

    function initVoyageSelect(element = null) {
        if (!element) {
            element = $("#voyage_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }
        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('mode.of.arrival.select2')}}"
                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , search: params.term
                        , type: "voyage"
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };

                }
            }
            , autoWidth: true
        , });
    }

    function initGenderSelect(element = null) {
        if (!element) {
            element = $("#gender_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }
        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('gender.select2')}}"
                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , search: params.term
                    , };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };

                }
            }
            , autoWidth: true
        , });
    }

    function initCountriesSelect(element = null) {
        if (!element) {
            element = $("#countries_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }

        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('countries.select2')}}"
                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , search: params.term
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };

                }
            }
            , autoWidth: true
        , });
    }

    function initCitiesSelect(element = null) {
        if (!element) {
            element = $("#cities_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }

        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('cities.select2')}}"
                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , county: $("#counties_select2").val()
                        , search: params.term
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };

                }
            }
            , autoWidth: true
        , });
    }

    function initStatesSelect(element = null) {
        if (!element) {
            element = $("#states_select2");
        }
        if ($(element).data("select2")) {
            $(element).select2("destroy");
        }

        $(element).select2({
            dropdownParent: element.parent()
            , ajax: {
                url: "{{route('states.select2')}}"
                , type: "post"
                , dataType: 'json'
                , delay: 250
                , data: function(params) {
                    return {
                        _token: $("meta[name='csrf-token']").attr('content')
                        , search: params.term
                    };
                }
                , processResults: function(response) {
                    return {
                        results: response
                    };
                }
            }
            , autoWidth: true
        , });
    }

</script>

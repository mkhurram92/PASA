        </div>

        <!--Footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                        Copyright © {{ date('Y') }} Pioneers.All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->

        </div>

        <!-- Back to top -->
        <a href="#top" id="back-to-top">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z" />
            </svg>
        </a>

        <!-- Jquery js-->
        <script src="{{ asset('js/vendors/jquery.min.js') }}"></script>

        <!-- Bootstrap5 js-->
        <script src="{{ asset('plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

        <!--Othercharts js-->
        <script src="{{ asset('plugins/othercharts/jquery.sparkline.min.js') }}"></script>

        <!-- Circle-progress js-->
        <script src="{{ asset('js/vendors/circle-progress.min.js') }}"></script>

        <!-- Jquery-rating js-->
        <script src="{{ asset('plugins/rating/jquery.rating-stars.js') }}"></script>

        <!-- P-scroll js-->
        {{-- <script src="{{ asset('plugins/p-scrollbar/p-scrollbar.js') }}"></script> --}}
        <script src="{{ asset('plugins/p-scrollbar/p-scrollbar.js') }}"></script>

        <!--Sidemenu js-->
        <script src="{{ asset('plugins/sidemenu/sidemenu.js') }}"></script>

        <!-- Sticky js -->
        <script src="{{ asset('js/sticky.js') }}"></script>

        <!-- ECharts js -->
        <script src="{{ asset('plugins/echarts/echarts.js') }}"></script>

        <!-- Peitychart js-->
        <script src="{{ asset('plugins/peitychart/jquery.peity.min.js') }}"></script>
        <script src="{{ asset('plugins/peitychart/peitychart.init.js') }}"></script>

        <!-- Apexchart js-->
        <script src="{{ asset('js/apexcharts.js') }}"></script>

        <!--Moment js-->
        <script src="{{ asset('plugins/moment/moment.js') }}"></script>

        <!-- Daterangepicker js-->
        <script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('js/daterange.js') }}"></script>

        <!---jvectormap js-->
        <script src="{{ asset('plugins/jvectormap/jquery.vmap.js') }}"></script>
        <script src="{{ asset('plugins/jvectormap/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('plugins/jvectormap/jquery.vmap.sampledata.js') }}"></script>

        <!-- Data tables js-->
        <script src="{{ asset('plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
        <script src="{{ asset('plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/js/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatable/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>

        <!-- Select2 js -->
        {{-- <script src="{{ asset('js/select2.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!--Counters -->
        {{-- <script src="{{ asset('../assets/plugins/counters/counterup.min.js') }}"></script> --}}
        <script src="{{ asset('plugins/counters/waypoints.min.js') }}"></script>

        <!--Chart js -->
        <script src="{{ asset('plugins/chart/chart.bundle.js') }}"></script>
        <script src="{{ asset('plugins/chart/utils.js') }}"></script>

        <!-- Jquery.steps js -->
        <script src="{{ asset('plugins/jquery-steps/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

        {{-- notification --}}
        <script src="{{ asset('plugins/notify/js/rainbow.js') }}"></script>
        <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
        <script src="{{ asset('plugins/notify/js/notifIt.js') }}"></script>

        <!-- Datepicker js -->
        <script src="{{ asset('plugins/date-picker/date-picker.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script>
        <script src="{{ asset('plugins/input-mask/jquery.maskedinput.js') }}"></script>

        <!-- Sweet alert js -->
        <script src="{{ asset('plugins/sweet-alert/jquery.sweet-modal.min.js') }}"></script>
        <script src="{{ asset('plugins/sweet-alert/sweetalert.min.js') }}"></script>

        <!-- Index js-->
        {{-- <script src="{{ asset('js/index1.js') }}"></script> --}}

        <!-- Color Theme js -->
        <script src="{{ asset('js/themeColors.js') }}"></script>

        <!-- Switcher-Styles js -->
        <script src="{{ asset('js/switcher-styles.js') }}"></script>

        <!-- Custom js-->
        <script src="{{ asset('js/custom.js') }}"></script>

        <script>
            window.addEventListener("DOMContentLoaded", function() {
                const parseErrorsIntoArray = errorObject => {
                    let errors = [];
                    $.each(errorObject.errors, (i, error) => {
                        if ($.isArray(error) && error.length > 0) {
                            $.each(error, (j, errorMsg) => {
                                if ($.trim(errorMsg) != "") {
                                    errors.push(errorMsg);
                                }
                            })
                        }
                    })
                    return errors;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    error: function(x, status, error) {
                        if (x.status == 401) {
                            $.growl.error({
                                message: "Session expired! Please login"
                            });
                        } else if (x.status == 403) {
                            $.growl.error({
                                message: "You are not authorized to access this area"
                            });
                        } else if (x.status == 422) {

                            const errors = parseErrorsIntoArray(x.responseJSON);
                            $.each(errors, (i, errorMsg) => {
                                $.growl.error({
                                    message: errorMsg
                                });
                            })
                        } else if (x.status == 500) {
                            $.growl.error({
                                message: "Unknown error occurred"
                            });
                        } else if (x.status == 404) {
                            $.growl.error({
                                message: "Resource not found"
                            });
                        }
                    }
                });
                $(document).on("click", "#logout", function(e) {
                    e.preventDefault();
                    $(e.target).parents("form")[0].submit();
                })
                $(document).on("submit", "form", function(e) {
                    e.preventDefault();
                    $.ajax($(e.target).attr("action"), {
                            type: "POST",
                            data: $(e.target).serialize(),
                        })
                        .done(res => {
                            if (res?.status && res?.message) {
                                $.growl.notice({
                                    title: "",
                                    message: res?.message
                                });
                                if (res?.redirectTo) {
                                    window.location.href = res?.redirectTo;
                                }

                                $('#crud').find(".modal").modal('hide');
                            }
                        })
                })
                try {
                    $.fn.select2.defaults.set("allowClear", true);
                    $.fn.select2.defaults.set("placeholder", "Select item");
                    $(document).on("click", ".close-modal", function(e) {
                        $(e.target).parents(".modal").modal("hide");
                    })

                } catch (error) {
                    console.log(error);
                }

            })
        </script>

        @yield('scripts')

        </body>

        </html>

        <!-- Bootstrap core JS-->
        <script src="<?php echo SERVERURL ?>views/js/sweetalert2.all.min.js"></script>
        <script src="<?php echo SERVERURL ?>views/js/jquery-3.6.4.min.js"></script>

        <script src="<?php echo SERVERURL ?>views/js/core/popper.min.js" type="text/javascript"></script>
        <script src="<?php echo SERVERURL ?>views/js/core/bootstrap.min.js" type="text/javascript"></script>

        <script src="<?php echo SERVERURL ?>views/js/plugins/perfect-scrollbar.min.js"></script>
        <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
        <script src="<?php echo SERVERURL ?>views/js/plugins/countup.min.js"></script>
        <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
        <script src="<?php echo SERVERURL ?>views/js/plugins/parallax.min.js"></script>
        <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
        <script src="<?php echo SERVERURL ?>views/js/soft-design-system.min.js" type="text/javascript"></script>

        <script src="<?php echo SERVERURL ?>views/datatable/datatables.js"></script>
        <script src="<?php echo SERVERURL ?>views/js/DateRange/moment.min.js"></script>
        <script src="<?php echo SERVERURL ?>views/js/DateRange/daterangepicker.js"></script>
        <script src="<?php echo SERVERURL ?>views/js/scripts.js"></script>
        <script>
          moment.locale('es', {
            months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
            monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
            weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
            weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
            weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
          });
        </script>
        <script src="<?php echo SERVERURL ?>views/js/alertas.js"></script>
        <script src="<?php echo SERVERURL ?>views/js/select2.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $('.selectSearch').select2();
        </script>
        </body>
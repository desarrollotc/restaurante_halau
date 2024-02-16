<script>


    var tabla = new DataTable('#tabla_inc', {

        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'

        },
        createdRow: (row, data, index) => {
            $(row).addClass('mb-0 text-sm');
        },
        /**************************** */
        responsive: true,
        serverSide: true,
        processing: true,
        fixedColumns: true,
        fixedHeader: true,
        autoWidth: false,
        stateSave: false,
        lengthMenu: false, // Solo mostrar la opción de 10 registros por página
        "autoWidth": false, // Desactiva el ajuste automático del ancho de la tabla
        "rowHeight": '50px', // Define el alto de las filas



        /**************************** */
        ajax: {
            url: '<?php echo SERVERURL ?>ajax/ListarhistorialAjax.php',
            type: 'POST',

        },
        columns: [


            {
                data: 'id_orden',
                name: 'id_orden',
                visible: false
            },
            {
                data: 'nombre_usuario',
                name: 'nombre_usuario'
                
            },
            {
                data: 'nombre_menu',
                name: 'nombre_menu'
            },
            {
                data: 'precio_menu_orden',
                name: 'precio_menu_orden'
            },
            {
                data: 'hora_pedido_orden',
                name: 'hora_pedido_orden'
            },

            {
                data: 'hora_recogida_orden',
                render: (data, type, row) => {
                if(row.hora_recogida_orden){
                    return row.hora_recogida_orden;
                }else{
                    return "No recogido";
                }

                }

            }

        ]

    });
    document.querySelectorAll('input.toggle-vis-programada').forEach((el) => {
        el.addEventListener('click', function(e) {
            //e.preventDefault();

            let columnIdx = e.target.getAttribute('data-column');
            let column = tabla.column(columnIdx);

            // Toggle the visibility
            column.visible(!column.visible());
        });
    });

    $(function() {
        $('#alertaPuedeConsultar').hide();
        //let start = moment().subtract(29, 'days');
        let start = moment();
        let end = moment();

        // establecer información en el input 
        function cb(start, end) {
            let startParam = start.format('YYYY-MM-DD');
            let endParam = end.format('YYYY-MM-DD');
            tabla.columns(7).search(startParam + ' ' + endParam).draw();
            $('#inputRangoCirugiasPendientes span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //$('#inputRangoCirugiasPendientes').data('daterangepicker').remove()
        }

        $('#inputRangoCirugiasPendientes').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Citas hoy': [moment(), moment()],
                'Citas ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Citas Ultimos 7 Días': [moment().subtract(6, 'days'), moment()],
                'Citas Ultimos 30 días': [moment().subtract(29, 'days'), moment()],
                'Citas Este Mes': [moment().startOf('month'), moment().endOf('month')],
                'Citas mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "locale": {
                "applyLabel": "Aceptar",
                "cancelLabel": "Canelar",
                "fromLabel": "Desde",
                "toLabel": "Hasta",
                "customRangeLabel": "Elegir otra fecha"
            }



        }, cb);


        console.log(start.format('YYYY-MM-DD') + ' ' + end.format('YYYY-MM-DD'));

        cb(start, end);



    })


    const Opcionerror = () => {
        $('#contenedorerror').removeClass('visually-hidden');
        $('#Motivo').attr("required", true); // syntax
    }

    const Opcionocultarerror = () => {
        $('#contenedorerror').addClass('visually-hidden');
        $('#Motivo').attr("required", false); // syntax
    }
</script>
<script>
 
//  function Botonaceptar(id_cita, nombre_paciente_orden){
// var lista =document.getElementById("motivo"); 
// console.log(lista.value);
// console.log(id_cita);
// Swal.fire({
//            title: 'Desea gestionar al paciente ' +  nombre_paciente_orden + '?',
//            showDenyButton: true,
//            confirmButtonText: 'Si',
//            denyButtonText: `No`,
//        }).then((result) => {
        
//            /* Read more about isConfirmed, isDenied below */
//            if (result.isConfirmed) {
               
//                window.location.href='<?php echo SERVERURL ?>estadosoporte/'+ id_cita + '/' + lista.value ;

//            }else{
//                     location.reload();
//         }
           
//        })
    
//  }
//  const ObtenerInfoCx = (id_citas, nombre_paciente_orden) => {
        

//        Swal.fire({
//            title: 'Desea editar al usuario ' +  nombre_paciente_orden + '?',
//            showDenyButton: true,
//            confirmButtonText: 'Si',
//            denyButtonText: `No`,
//        }).then((result) => {
        
//            /* Read more about isConfirmed, isDenied below */
//            if (result.isConfirmed) {
               
//                window.location.href='<?php echo SERVERURL ?>editarpaciente/'+ id_citas ;

//            }
           
//        })

//     }
//     const Cambiarestado = (id_usuario, nombre_usuario, estado_usuario) => {
        

//         Swal.fire({
//             title: 'Desea cambiar el estado del usuario ' +  nombre_usuario + '?',
//             showDenyButton: true,
//             confirmButtonText: 'Si',
//             denyButtonText: `No`,
//         }).then((result) => {
         
//             /* Read more about isConfirmed, isDenied below */
//             if (result.isConfirmed) {
                
//                 window.location.href='<?php echo SERVERURL ?>Estado/'+ id_usuario + '/' + estado_usuario;
 
//             }
            
//         })
 
//      }

    var tabla = new DataTable('#tabla_inc',{
        
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
        stateSave : false,
        
   
        /**************************** */
        ajax: {
            url: '<?php echo SERVERURL ?>ajax/ListarpedidosAjax.php',
            type: 'POST',

        },
        columns: [
            //{ data:'ID_ORDENES_PEND', name:'ID_ORDENES_PEND' },
            
            
            {
                data: 'id_orden',
                name: 'id_orden',
                visible:false
            },
            {
                data: 'cliente',
                name: 'cliente'
            },
                {
                data: 'nombre_menu',
                name: 'nombre_menu'
            },
            
            {
                data: 'hora_pedido_orden',
                name: 'hora_pedido_orden'
                
            },
            {
                data: 'estado_orden',
                render: (data, type, row) => {
                    if(row.estado_orden == 2){
                    return `Pendiente`;
                    }else{
                        return `Reclamado`;
                    }
                  
                }
                
            },
           
            { 
            data: 'id_orden',
            
                 render: (data, type, row) => {
                    
                     return `<button  type="button" class="btn btn-outline-info" id="editb" onclick="ObtenerInfoCx('` + row.id_citas + `','` + row.nombre_paciente_orden + `') ">Gestionar</button>`;
                 
                   
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
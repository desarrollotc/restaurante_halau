<script>
    function Botonaceptar(id_menu, nombre_menu, estado_menu) {
        var lista = document.getElementById("motivo");
        Swal.fire({
            title: 'Desea cambiar el estado de ' + nombre_menu + '?',
            showDenyButton: true,
            confirmButtonText: 'Si',
            denyButtonText: `No`,
        }).then((result) => {

            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                window.location.href = '<?php echo SERVERURL ?>cambioestado/' + id_menu + '/' + estado_menu;

            }

        })

    }

    const ObtenerInfo = (id_menu, nombre_menu) => {


        Swal.fire({
            title: 'Desea editar la información de ' + nombre_menu + '?',
            showDenyButton: true,
            confirmButtonText: 'Si',
            denyButtonText: `No`,
        }).then((result) => {
            var id_result = btoa(JSON.stringify(id_menu))
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                id_result = id_result.replaceAll('=', '');
                window.location.href = '<?php echo SERVERURL ?>editarmenu/' + encodeURIComponent(id_result);

            }

        })

    }



    // const ObtenerInfo = (id_menu, nombre_menu) => {
    //     var lista = document.getElementById("cantidad");
    //     console.log(lista.value);
    //     Swal.fire({
    //         title: 'Desea ingresar esta cantidad sobre ' + nombre_menu + '?',
    //         showDenyButton: true,
    //         confirmButtonText: 'Si',
    //         denyButtonText: `No`,
    //     }).then((result) => {
    //         console.log(lista.value);
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //             console.log(lista.value);
    //         var datoss = {
    //             id: id_menu,
    //             cantidad: lista.value
    //         };
    //         console.log(datoss);
    //         var cantidadJSON = JSON.stringify(datoss);

    //             fetch('ajax/ListarmenuAjax.php',{
    //                 method: 'POST',
    //                 headers:{
    //                     'Content-Type': 'application/json'
    //                 },
    //                 body:cantidadJSON
    //             })

    //         }

    //     })

    // }

    let search = 'search'
    let datos = new FormData();
    datos.append('draw', 'draw');
    datos.append('start', '0');
    datos.append('length', '0');
    datos.append('search[value]', {
        value: 0
    });
    datos.append('draw', 'draw');
    datos.append('order', 1);


    var tabla = new DataTable('#tabla_inc', {

        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'

        },
        createdRow: (row, data, index) => {
            $(row).addClass('mb-0 text-sm');
        },
        /**************************** */
        responsive: true,
        // serverSide: true,
        // processing: true,
        fixedColumns: true,
        fixedHeader: true,
        autoWidth: false,
        stateSave: false,
        lengthMenu: false, // Solo mostrar la opción de 10 registros por página
        autoWidth: false, // Desactiva el ajuste automático del ancho de la tabla
        rowHeight: '50px', // Define el alto de las filas

        columns: [


            {
                data: 'id_menu',
                name: 'id_menu',
                visible: false
            },
            {
                data: 'nombre_menu',
                name: 'nombre_menu'

            },
            {
                data: 'precio_menu',
                name: 'precio_menu'
            },
            {
                data: 'cantidad_menu',
                name: 'cantidad_menu'

            },
            {
                data: 'estado_menu',

                render: (data, type, row) => {
                    if (row.estado_menu == 1) {
                        row.estado_menu = 2;
                        return `<button  type="button" class="btn btn-success" id="motivo" onclick="Botonaceptar('` + row.id_menu + `','` + row.nombre_menu + `','` + row.estado_menu + `')">Activo</button>`;
                    } else {
                        row.estado_menu = 1;
                        return `<button  type="button" class="btn btn-warning" id="motivo" onclick="Botonaceptar('` + row.id_menu + `','` + row.nombre_menu + `','` + row.estado_menu + `')">Inactivo</button>`;
                    }

                }

            },
            {
                data: 'id_menu',
                render: (data, type, row) => {
                    return `<button  type="button" class="btn btn-primary" onclick="ObtenerInfo('` + row.id_menu + `','` + row.nombre_menu + `')">Editar</button>`;
                }
            }
        ]

    });

    $(tabla).ready(() => {
        $.ajax({
            url: "<?php echo SERVERURL; ?>ajax/ListarmenuAjax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST'
        }).done((result) => {
            let data = JSON.parse(result);
            console.log(data);

            tabla.clear().rows.add(data).draw();
        })
    })

    setInterval(() => {




        

        $.ajax({
            url: "<?php echo SERVERURL; ?>ajax/ListarmenuAjax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST'
        }).done((result) => {
            let data = JSON.parse(result);
            console.log(data);

            tabla.clear().rows.add(data).draw();
        })


    }, 15000);
</script>
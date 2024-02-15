<script>

$('#generar_excel').on('click',()=>{
        let numero_usuario = $('#numero_usuario').val();
        let fecha_inicio= $('#fecha_inicio').val();
        let fecha_fin= $('#fecha_fin').val();
        const d = new Date();
        var año = d.getFullYear();
        var mes = ('0' + (d.getMonth() + 1)).slice(-2);
        var dia = ('0' + d.getDate()).slice(-2);
        var fecha_actual = año + '-' + mes + '-' + dia;
        console.log(fecha_fin);
        console.log(fecha_actual);

        // if(fecha_inicio < fecha_fin){
        //     alert("N0o");
        // }else if(fecha_inicio > fecha_fin){
        //     alert("suuiaso")
        // }
        if(fecha_inicio=='' || fecha_fin ==''){
                Swal.fire({
                position: "center",
                icon: "error",
                title: "Ingrese un rango de fechas validos",
                showConfirmButton: false,
                timer: 1500
                });
        }else{
            window.open('<?php echo SERVERURL; ?>Excel/'+numero_usuario+'/'+fecha_inicio+'/'+fecha_fin);
        }

     })


</script>
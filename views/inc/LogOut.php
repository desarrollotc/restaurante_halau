<script>
    let btn_log=document.querySelector('#cerrar_sesion');
    btn_log.addEventListener('click',function(e){
        e.preventDefault();
        Swal.fire({
        icon: 'question',
        title: 'Estas seguro ?',
        text: 'Cerrar la sesión',
        showCancelButton:true,
        confirmButtonText: 'Aceptar',
        cancelButtonText:'Cancelar'
      }).then((result) => {

         if (result.isConfirmed) {
            let URL= '<?php echo SERVERURL; ?>ajax/LoginAjax.php';
            let usuario='<?php echo $_SESSION['numero_spm'];?>';
            let tocken='<?php echo $lc->encryption($_SESSION['token_spm']) ?>';
            let datos = new FormData();
            datos.append('token',tocken);
            datos.append('numero',usuario);
            fetch(URL,{
                method:'POST',
                body:datos

            }).then(respuesta=>respuesta.json())
            .then(respuesta=>{
                return alertas_ajax(respuesta)
            })
        }
        }) 
    }) ;

</script>
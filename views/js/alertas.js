//todos los formularios deben tener esa claseasdasd
const formularios_ajax= document.querySelectorAll('.FormularioAjax');

function enviar_formulario_ajax(e){
    e.preventDefault();
    let data=new FormData(this);
    //console.log(data);
    let method=this.getAttribute("method");
    let action=this.getAttribute("action");
    let tipo=this.getAttribute("data-form");
    //form class="form-neon FormularioAjax" method="POST" data-form="save"
    //form class="form-neon FormularioAjax" method="POST" data-form="delete"
    //form class="form-neon FormularioAjax" method="POST" data-form="update"
    let encabezados= new Headers();
    let config={
        method:method,
        headers:encabezados,
        mode:'cors',
        cache:'no-cache',
        body: data
    }

    let texto_alerta;
    if(tipo==='save'){
        texto_alerta="Los datos serán guardados";
    }else if(tipo==='update'){
        texto_alerta="Los datos serán actualizados";
    }else if(tipo==='delete'){
        texto_alerta="Los datos serán eliminados";
    }else if(tipo==='search'){
        texto_alerta="Los datos serán borrados de busquea";

    }else if(tipo==='citas_cancelar'){
        texto_alerta="Los datos serán borrados de busquea";

    }else{
        texto_alerta="¿Esta seguro(a) de continuar? ";
    }


    
    Swal.fire({
        icon: 'question',
        title: 'Realizar cambios',
        text: texto_alerta,
        showCancelButton:true,
        confirmButtonText: 'Aceptar',
        cancelButtonText:'Cancelar'
      }).then((result) => {
 if (result.isConfirmed) {

            fetch(action,config)
            .then(respuesta=>respuesta.json())
            .then(respuesta=>{
             
                 return alertas_ajax(respuesta);
                
            })
        }

      })

}

formularios_ajax.forEach(formulario=>{
    formulario.addEventListener('submit',enviar_formulario_ajax);
})


function alertas_ajax(alerta) {
     console.log(alerta);

    

    if(alerta.Alerta==="simple"){
        Swal.fire({
            icon: alerta.Icono,
            title: alerta.Titulo,
            text: alerta.Texto,
            confirmButtonText: 'Aceptar',
            cancelButtonText:'Cancelar'
          })
    }else if(alerta.Alerta==="dialogo"){
        Swal.fire({
            icon: alerta.Icono,
            title: alerta.Titulo,
            position: alerta.Posicion,
            showConfirmButton: alerta.Boton,
            timer: alerta.Tempo,
            timerProgressBar: alerta.Progress,
            willClose: ()=> {
                window.location.href = alerta.URL;
            }
          })
    }else if(alerta.Alerta==="dialogob"){
        Swal.fire({
            icon: alerta.Icono,
            title: alerta.Titulo,
            position: alerta.Posicion,
            showConfirmButton: alerta.Boton,
            timer: alerta.Tempo,
            timerProgressBar: alerta.Progress,
          })
    }else if(alerta.Alerta==="recargar"){
        Swal.fire({
            icon: alerta.Icono,
            title: alerta.Titulo,
            text: alerta.Texto,
            confirmButtonText: 'Aceptar',
            
          }).then((result) => {
        
            if (result.isConfirmed) {
                location.reload();
            } else if (result.isDenied) {
            
            }
          })

    }else if(alerta.Alerta==="limpiar"){
        Swal.fire({
            icon: alerta.Icono,
            title: alerta.Titulo,
            text: alerta.Texto,
            confirmButtonText: 'Aceptar',
            
          }).then((result) => {
          
            if (result.isConfirmed) {
              // document.querySelector(".FormularioAjax").reset();
               window.location.href=alerta.URL;
            } else if (result.isDenied) {
            
            }
          })
    }else if(alerta.Alerta==="redireccionar"){
        window.location.href=alerta.URL;
    }
    
    

  }


  
  























































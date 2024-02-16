<script>

 function Pruebasweet(){
        Swal.fire({
  title: ":D",
  width: 600,
  padding: "3em",
  color: "#716add",
  background: "#fff url(https://media.tenor.com/-AyTtMgs2mMAAAAi/nyan-cat-nyan.gif)",
  backdrop: `
    rgba(0,0,123,0.4)
    url("https://media1.tenor.com/m/ahzlbHy6jq4AAAAd/dragon-ball-goku.gif")
    left top
    no-repeat
  `
});

 }


$('#generar_excel').on('click',()=>{
        let numero_usuario = $('#numero_usuario').val();
        let fecha_inicio= $('#fecha_inicio').val();
        let fecha_fin= $('#fecha_fin').val();
        const d = new Date();
        var año = d.getFullYear();
        var mes = ('0' + (d.getMonth() + 1)).slice(-2);
        var dia = ('0' + d.getDate()).slice(-2);
        var fecha_actual = año + '-' + mes + '-' + dia;

        if(fecha_inicio=='' && fecha_fin ==''){
                Swal.fire({
                position: "center",
                icon: "error",
                title: "Ingrese un rango de fechas para continuar.",
                showConfirmButton: false,
                timer: 1500
                });
        }else if(fecha_inicio!='' || fecha_fin ==''){
                fecha_fin = fecha_actual;
                if(fecha_inicio <= fecha_fin){
                window.location.href='<?php echo SERVERURL; ?>Excel/'+numero_usuario+'/'+fecha_inicio+'/'+fecha_fin;
                }else{
                Swal.fire({
                position: "center",
                icon: "error",
                title: "La fecha inicial es mayor a la fecha final",
                showConfirmButton: false,
                timer: 1500
                });     
                }
        }else if(fecha_inicio=='' || fecha_fin !=''){
                Swal.fire({
                position: "center",
                icon: "error",
                title: "Ingrese una fecha inicial valida.",
                showConfirmButton: false,
                timer: 1500
                });
        }else if(fecha_inicio > fecha_fin){
                Swal.fire({
                position: "center",
                icon: "error",
                title: "La fecha inicial es mayor a la fecha final.",
                showConfirmButton: false,
                timer: 1500
                });   
        }else if(fecha_inicio <= fecha_fin){
                window.location.href='<?php echo SERVERURL; ?>Excel/'+numero_usuario+'/'+fecha_inicio+'/'+fecha_fin;
        }
     })


</script>
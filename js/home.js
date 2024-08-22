"use strict";

document.querySelector("#btnCodigo").addEventListener(
    "click",  (event) => {
        const etiqueta=document.querySelector("#lblCodigo");
        const campo=document.querySelector("#codigo");
        const submit=document.querySelector("#btnSubmit");
        const mensaje=document.querySelector("#mensaje");
        const ruc=document.querySelector("#ruc");
        const correo=document.querySelector("#correo");
        const msgError=document.querySelector("#msgError");
        const msgBusqueda=document.querySelector("#msgBusqueda");
        const msgconsulta=document.querySelector("#msgconsulta");
        const respCorreo=document.querySelector("#respCorreo");
        const msgOk=document.querySelector("#msgOk");

        const ruta="http://localhost/formDatos/index.php?controlador=busqueda&ruc="+ruc.value+"&correo="+correo.value;
        const rutaCorreo="http://localhost/formDatos/index.php?controlador=correo&ruc="+ruc.value+"&mail="+correo.value;

        msgError.style.display="none";
        msgBusqueda.style.display="none";
        msgconsulta.innerHTML='';
        msgOk.innerHTML='';
        
        if (ruc.value!='' && correo.value!=''){
           async function fetchCorreoJSON (){
                 const response = await fetch(rutaCorreo);
                 msgBusqueda.style.display="block"; 

                 if (!response.ok) {
                    const message = `Un error ocurrió: ${response.status}`;
                    msgconsulta.style.color="red";
                    msgconsulta.innerHTML="Error 404 - Página no encontrada."+message;
                    throw new Error(message);
                 }          
                 
                 const envioCorreo = await response.json();
                 console.log("###########");
                 console.log(envioCorreo);  
                 console.log("###########");  
                 
                 return envioCorreo;
           }

           async function fetchBusquedaJSON() {
                 const response = await fetch(ruta);
                 msgBusqueda.style.display="block"; 

                 console.log("###########busqueda#############");
                 console.log(response);
                 console.log("###########fin busqueda#########");

                 if (!response.ok) {
                    const message = `Un error ocurrió: ${response.status}`;
                    console.log("###########error busqueda#############");
                    console.log(message);
                    console.log("###########fin error busqueda#########");

                    msgconsulta.style.color="red";
                    msgconsulta.innerHTML="Error 404 - Página no encontrada."+message;
                    throw new Error(message);
                 }

                 const resultado = await response.json();
                 console.log("###########despues busqueda#############");
                 console.log(resultado);
                 console.log("###########fin despues busqueda#############");

                 if(resultado.mensaje=="No"){
                   msgconsulta.style.color="red";
                   msgconsulta.innerHTML="No se pudo enviar el código de acceso al correo indicado. Cliente no existe o ya realizó la actualización de datos.";
                 }
                 else{
                     if(resultado.mensaje=="Ok"){
                        fetchCorreoJSON().catch(error => {
                          error.message; // 'An error has occurred: 404'
                        });

                        etiqueta.style.display="block";
                        campo.style.display="block";
                        submit.style.display="block";
                        msgconsulta.style.color="green";
                        msgconsulta.innerHTML="Se envió un código de acceso al correo indicado.";                        
                     }
                 }

                 return resultado.mensaje;
           }          

           fetchBusquedaJSON().catch(error => {
            error.message; // 'An error has occurred: 404'
          });
        }
        else{
            msgError.style.display="block";
        }

        event.preventDefault();
   }
);
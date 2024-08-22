"use strict";

function validaIdentificacion(){
    let mensaje='';
    let tipo=document.querySelector("#lstTipoIdent");
    let numero=document.querySelector("#ruc");
    let nombre=document.querySelector("#razonSocial");
    let msgError=document.querySelector("#msgRuc");
        
    msgError.innerHTML='';

    if (tipo.value==1 && numero.value.length!=13){
        msgError.style.display="block";
        mensaje='El # de identificación debe tener al menos 13 caracteres';
    }

    if (tipo.value==2 && numero.value.length!=10){
        msgError.style.display="block";
        mensaje='El # de identificación debe tener al menos 10 caracteres';
    }    

    if (tipo.value==3 && numero.value.length>15){
        msgError.style.display="block";
        mensaje='El # de identificación no puede ser mayor a 15 caracteres';
    }    
    
    msgError.innerHTML=mensaje;

    if(mensaje!=''){
        numero.value="";
        numero.focus();
    }
    else{
        msgError.style.display="none";
        nombre.focus();
    }
}

function backPage(){
         const etiqueta=document.querySelector("#lblCodigo");
         const campo=document.querySelector("#codigo");
         const submit=document.querySelector("#btnSubmit");   
         const msgconsulta=document.querySelector("#msgconsulta"); 
         msgconsulta.innerHTML='';
         
         window.history.back();
         
         etiqueta.style.display="block";
         campo.style.display="block";
         submit.style.display="block";
                  
}

function patronTelefono(patronTel,listaTipo,telefono){
         const patron=document.querySelector("#"+patronTel);
         const tipo=document.querySelector("#"+listaTipo);
         const numero=document.querySelector("#"+telefono);

         if(tipo.value==1){
            patron.innerHTML="Patrón permitido: 0990999999";  
         }
         else{
            patron.innerHTML="Patrón permitido: 042824441";   
         }         
}

function validaTelefono(telefono,tipo,tipoContacto){
       const numero=document.querySelector("#"+telefono);  
       const tipotel=document.querySelector("#"+tipo); 
       let descripcion='';

       if(tipoContacto=='C'){
         descripcion='Contacto Comercial';
       }
       else{
           if(tipoContacto=='F'){
            descripcion='Contacto Financiero';
          }          
       }

       if(tipotel.value==1){
            if(!/^[0-9]{10}$/.test(numero.value)){
                    alert('Número de teléfono para '+descripcion+' no válido.');
                    numero.value='';
                    numero.focus();
                    return false;
            }
       }
       else{
            if(!/^[0-9]{9}$/.test(numero.value)){
                alert('Número de teléfono para '+descripcion+' no válido.');
                numero.value='';
                numero.focus();
                return false;
            }        
       }

       return true;
}

function patronesDefault(){
         patronTelefono('patronContacto','lstTipoTelC');
         patronTelefono('patronContactoF','lstTipoTelF');
}

function validaTelefonosSubmit(event){ 
         event.preventDefault(); 

         const valida_1=validaTelefono('telContactoF','lstTipoTelF','F');
         const valida_2=validaTelefono('telContactoC','lstTipoTelC','C');

         if(valida_1 && valida_2){
            event.currentTarget.submit();
         }         
}

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de datos</title>
    <script src="js/utilidades.js"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body onload="patronesDefault();">
    <style>
        fieldset{
            border: solid 4px #ff8c00;
            padding : 20px;
            margin: 10px;   
            width: 100%;
            border-radius: 10px 10px 10px 10px;
        }

        label{
            font-weight: bold;
        }

        legend{
            color: #ff8c00;
            font-weight: bold;
        }

        h1{
            border-left: solid 10px #ff8c00;
            margin: 10px;
            padding: 10px;
            color:  #ff8c00;
            font-weight: bold;
        }

        input:invalid { border-color: red; border:  } input, input:valid { border-color: #ccc; }        

        #msgRuc{
            display: none;
            color: red;
        }
    </style>
    <div class="container-sm w-75">
        <h1 align="center">Actualización de Datos</h1>
    </div>
    <hr>
    <form method="post" onsubmit="validaTelefonosSubmit(event);" action="<?php echo htmlentities($_SERVER['PHP_SELF']."?controlador=frmactualiza"); ?>">
    <?php
    while ($item = $vars["listado"]->fetch()) {   
    ?>    
        <div class="container-sm w-75">
            <div class="row">
                <div class="col">
                    <label class="label-control" for="lstTipoIdent">Tipo Identificación:</label>

                    <?php 
                        if (isset($item['TIPO_ID_TRIBUTARIO'])) { 
                           $tipoId=$item['TIPO_ID_TRIBUTARIO'];
                        } 
                        else{
                            $tipoId=1;
                        }
                    ?>                    
                    <select class="form-control m-2" name="lstTipoId" id="lstTipoId" onChange="validaIdentificacion();" disabled>
                        <option value="1" <?php if($tipoId==1){ echo "selected"; } ?>>Ruc</option>                
                        <option value="2" <?php if($tipoId==2){ echo "selected"; } ?>>Cedula</option>                
                        <option value="3" <?php if($tipoId==3){ echo "selected"; } ?>>Pasaporte</option>                
                    </select>
                </div>
                <div class="col">
                    <p align='center' id="msgRuc"> </p>
                    <label class="label-control" for="ruccons"># Identificación:</label>
                    <input class="form-control m-2" name="ruccons" id="ruccons" onChange="validaIdentificacion();" type="number" maxlength="15" value="<?php if(isset($item["IDENTIFICACION"])) {echo $item["IDENTIFICACION"];}?>"  disabled/>
                </div>
            </div>
            
            <div class="row">
                    <input class="form-control m-2" name="lstTipoIdent" id="lstTipoIdent" type="hidden" value="<?php if(isset($tipoId)) {echo $tipoId;}?>" required/>
                    <input class="form-control m-2" name="ruc" id="ruc" type="hidden" value="<?php if(isset($_POST["ruc"])) {echo $_POST["ruc"];}?>" required/>
                    <input class="form-control m-2" name="rucKey" id="rucKey" type="hidden" value="<?php if(isset($_POST["ruc"])) {echo $_POST["ruc"];}?>" required/>
                    <input class="form-control m-2" name="no_cliente" id="no_cliente" type="hidden" value="<?php if(isset($item["NO_CLIENTE"])) {echo $item["NO_CLIENTE"];}?>"/>          
                    <input class="form-control m-2" name="no_sub_cliente" id="no_sub_cliente" type="hidden" value="<?php if(isset($item["NO_SUB_CLIENTE"])) {echo $item["NO_SUB_CLIENTE"];}?>" />  
                    <input class="form-control m-2" name="divComercial" id="divComercial" type="hidden" value="<?php if(isset($item["DIVISION_COMERCIAL"])) {echo $item["DIVISION_COMERCIAL"];}?>"/>  
                    <input class="form-control m-2" name="estado" id="estado" type="hidden" value="<?php if(isset($item["ESTADO"])) {echo $item["ESTADO"];}?>"/>  
                    <input class="form-control m-2" name="estadoLocal" id="estadoLocal" type="hidden" value="<?php if(isset($item["ESTADO_LOCAL"])) {echo $item["ESTADO_LOCAL"];}?>"/>  
                    <input class="form-control m-2" name="nombre" id="nombre" type="hidden" value="<?php if(isset($item["NOMBRE"])) {echo $item["NOMBRE"];}?>"/>  
                    <input class="form-control m-2" name="condTrib" id="condTrib" type="hidden" value="<?php if(isset($item["CONDICION_TRIBUTARIA"])) {echo $item["CONDICION_TRIBUTARIA"];}?>"/>                              
                    <input class="form-control m-2" name="descCondTrib" id="descCondTrib" type="hidden" value="<?php if(isset($item["DESC_COND_TRIBUTARIA"])) {echo $item["DESC_COND_TRIBUTARIA"];}?>"/>                              
            </div>

            <label class="label-control m-2" for="razonSocial">Nombre Contribuyente/Razón Social:</label>
            <input class="form-control m-2" name="razonSocial" id="razonSocial" type="text" required value="<?php echo $item['NOMBRE'];?>"/>

            <label class="label-control m-2" for="nomComercial">Nombre Comercial:</label>
            <input class="form-control m-2" name="nomComercial" id="nomComercial" type="text" required value="<?php echo $item['NOMBRE_COMERCIAL'];?>"/>

            <label class="label-control m-2" for="repLegal">Representante Legal:</label>
            <input class="form-control m-2" name="repLegal" id="repLegal" type="text" required />        
            
            <?php if (isset($item['TIPO_CONTRIBUYENTE'])) { 
                     if($item['TIPO_CONTRIBUYENTE']=='NATURAL'){ 
                        $tipo='N'; 
                     }
                     else{
                        $tipo='J';
                     } 
                  } 
            ?>

            <label class="label-control m-2" for="tipoContr">Tipo Contribuyente:</label>
            <select class="form-control" name="tipoContr" id="tipoContr" required>
                <option value="N" <?php if($tipo=='N'){ echo "selected"; }?> >Natural</option>                
                <option value="J" <?php if($tipo=='J'){ echo "selected"; }?> >Jurídica</option>                
            </select>

            <?php if (isset($item['CONDICION_TRIBUTARIA'])) { 
                     if($item['CONDICION_TRIBUTARIA']=='03'){ 
                        $contrEsp='S'; 
                     }
                     else{
                        $contrEsp='N';
                     } 
                  } 
            ?>            

            <label class="label-control m-2" for="contrEsp">Contribuyente Especial:</label>
            <select class="form-control" name="contrEsp" id="contrEsp" required>
                <option value="S" <?php if($contrEsp=='S'){ echo "selected"; }?> >Si</option>                
                <option value="N" <?php if($contrEsp=='N'){ echo "selected"; }?> >No</option>                
            </select>            

            <?php if (isset($item['OBLIGADO_CONTABILIDAD'])) { 
                     if($item['OBLIGADO_CONTABILIDAD']=='S'){ 
                        $obligada='S'; 
                     }
                     else{
                        $obligada='N';
                     } 
                  } 
            ?>            
            
            <label class="label-control m-2" for="oblContabilidad">Obligado a llevar contabilidad?</label>
            <select class="form-control" name="oblContabilidad" id="oblContabilidad" required>
                <option value="S" <?php if(isset($obligada)){ if ($obligada=='S') { echo "selected";}}  ?> >Si</option>                
                <option value="N" <?php if(isset($obligada)){ if ($obligada=='N') { echo "selected";}}  ?> >No</option>                
            </select>     
            
            <?php if (isset($item['TIPO_REGIMEN'])) { 
                     if($item['TIPO_REGIMEN']=='REGIMEN GENERAL'){ 
                        $regimen='5'; 
                     }
                     else{
                        if($item['TIPO_REGIMEN']=='GRAN_CONTR'){ 
                           $regimen='7';
                        }
                        else{
                            if($item['TIPO_REGIMEN']=='NACIONALES'){ 
                                $regimen='2';
                             }    
                             else{
                                if($item['TIPO_REGIMEN']=='EXTRANJEROS'){ 
                                    $regimen='1';
                                 }       
                                 else{
                                    if($item['TIPO_REGIMEN']=='RIMPE'){ 
                                        $regimen='3';
                                    }   
                                    else{
                                        if($item['TIPO_REGIMEN']=='RIMPENEG'){ 
                                            $regimen='4';
                                        }              
                                        else{
                                            $regimen='6';
                                        }                            
                                    }
                                 }                            
                             }                        
                        }
                     } 
                  } 
            ?>

            <label class="label-control m-2" for="tipoRegimen">Tipo regimen:</label>
            <select class="form-control" name="tipoRegimen" id="tipoRegimen" required>
                <option value="1" <?php if(isset($regimen)){ if($regimen==1){ echo "selected"; } } ?>>Extranjeros</option>                
                <option value="2" <?php if(isset($regimen)){ if($regimen==2){ echo "selected"; } } ?>>Nacionales</option>                
                <option value="3" <?php if(isset($regimen)){ if($regimen==3){ echo "selected"; } } ?>>Rimpe Emprendedor</option>    
                <option value="4" <?php if(isset($regimen)){ if($regimen==4){ echo "selected"; } } ?>>Rimpe Negocio Popular</option>   
                <option value="5" <?php if(isset($regimen)){ if($regimen==5){ echo "selected"; } } ?>>Regimen General</option>   
                <option value="6" <?php if(isset($regimen)){ if($regimen==6){ echo "selected"; } } ?>>Sociedad sin fines de lucro</option>   
                <option value="7" <?php if(isset($regimen)){ if($regimen==7){ echo "selected"; } } ?>>Gran Contribuyente</option>   
            </select>               

            <label class="label-control m-2" for="correo">Correo:</label>
            <input class="form-control m-2" name="correo" id="correo" type="email"  required value="<?php echo $item['EMAIL_COMERCIAL'];?>"/>            
        </div>
        <hr>
        <div class="container-sm w-75">
            <fieldset>
                <legend>Datos de Contacto - Financiero</legend>
                <label class="label-control m-2" for="nomContactoF">Nombre de Contacto:</label>
                <input class="form-control m-2" name="nomContactoF" id="nomContactoF" type="text"  required/>   

                <label class="label-control m-2" for="lstTipoTelF">Tipo Teléfono:</label> 
                <select class="form-control" id="lstTipoTelF" name="lstTipoTelF" onclick="patronTelefono('patronContactoF','lstTipoTelF','telContactoF');">
                    <option value="1" selected>Celular</option>
                    <option value="2">Fijo</option>
                </select>

                <label class="label-control m-2" for="telContactoF">Teléfono de Contacto:</label> <small id="patronContactoF"></small>
                <input class="form-control m-2" name="telContactoF" id="telContactoF" onchange="validaTelefono('telContactoF','lstTipoTelF','F');" type="number" required />  

                <label class="label-control m-2" for="correoContactoF">Correo de Contacto:</label>
                <input class="form-control m-2" name="correoContactoF" id="correoContactoF" type="email"  required />   
            </fieldset>
        </div>

        <div class="container-sm w-75">
            <fieldset>
                <legend>Datos de Contacto - Comercial</legend>
                <label class="label-control m-2" for="nomContactoC">Nombre de Contacto:</label>
                <input class="form-control m-2" name="nomContactoC" id="nomContactoC" type="text"  required value="<?php echo $item['CONTACTO_COMERCIAL'];?>"/>   

                <label class="label-control m-2" for="lstTipoTelC">Tipo Teléfono:</label> 
                <select class="form-control" id="lstTipoTelC" name="lstTipoTelC" onclick="patronTelefono('patronContacto','lstTipoTelC','telContactoC');">
                    <option value="1" selected>Celular</option>
                    <option value="2">Fijo</option>
                </select>

                <label class="label-control m-2" for="telContactoC">Teléfono de Contacto:</label> <small id="patronContacto"></small>
                <input class="form-control m-2" name="telContactoC" id="telContactoC" onchange="validaTelefono('telContactoC','lstTipoTelC','C');" type="number"  required value="<?php echo $item['TELEFONO_COMERCIAL'];?>"/>  

                <label class="label-control m-2" for="correoContactoC">Correo de Contacto:</label>
                <input class="form-control m-2" name="correoContactoC" id="correoContactoF" type="email"  required value="<?php echo $item['EMAIL2'];?>"/>   

                <label class="label-control m-2" for="direccionPrincipal">Dirección oficina principal:</label>
                <input class="form-control m-2" name="direccionPrincipal" id="direccionPrincipal" type="text"  required value="<?php echo $item['DIRECCION_OFICINA'];?>"/>                 
            </fieldset>
        </div>      
        
        <div class="container-sm w-25">
            <div class="row">
                <input type="submit" class="btn btn-success m-2" value="Actualizar" />
            </div>
        </div>

    <?php } ?> 

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>
<?php
class FrmActualizaController{
    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }
 
    public function index()
    {
        //Incluye el modelo que corresponde
        require 'models/ClientesModel.php';

        if (isset($_POST)){
           //Creamos una instancia de nuestro "modelo"
           $items = new ClientesModel();      
           
           if($_POST["tipoContr"]=='N'){
             $tipoContribuyente='Natural';
           }
           else{
             $tipoContribuyente='Jurídica';
           }

           if ($_POST['tipoRegimen']=='5'){ 
              $regimen='REGIMEN GENERAL';
           }
           else{
               if ($_POST['tipoRegimen']=='7'){ 
                  $regimen='GRAN_CONTR';
               }
               else{
                     if ($_POST['tipoRegimen']=='2'){ 
                        $regimen='GRAN_CONTR';
                     }       
                     else{
                           if ($_POST['tipoRegimen']=='1'){ 
                              $regimen='EXTRANJEROS';
                           }       
                           else{
                                 if ($_POST['tipoRegimen']=='3'){ 
                                    $regimen='RIMPE';
                                 }   
                                 else{
                                       if ($_POST['tipoRegimen']=='4'){ 
                                          $regimen='RIMPENEG';
                                       }              
                                       else{
                                              $regimen='SOCIEDAD SIN FINES DE LUCRO';
                                       }                            
                                 }
                            }                            
                     }                        
                }
            } 

            if($_POST['lstTipoIdent']==1){
                $desc_tipo_ident="RUC";
            }
            else{
                if($_POST['lstTipoIdent']==2){
                    $desc_tipo_ident="CEDULA";
                }        
                else{
                    if($_POST['lstTipoIdent']==3){
                        $desc_tipo_ident="PASAPORTE";
                    }                    
                }        
           }

           $busca=$items->consultaCliente($_POST['rucKey']);

           if($busca->rowCount()>0){
                $sql="insert into clientes_actualizados (NO_CIA,NO_CLIENTE,NO_SUB_CLIENTE,IDENTIFICACION,NOMBRE,NOMBRE_COMERCIAL,
                RAZON_SOCIAL,TIPO_ID_TRIBUTARIO,DESC_ID_TRIBUTARIO,TIPO_REGIMEN,DIRECCION_OFICINA,CONDICION_TRIBUTARIA,DESC_COND_TRIBUTARIA,
                TIPO_CONTRIBUYENTE,CONTRIBUYENTE_ESPECIAL,DIVISION_COMERCIAL,ESTADO,ESTADO_LOCAL, TELEFONO_COMERCIAL, EMAIL_COMERCIAL,CONTACTO_COMERCIAL,
                OBLIGADO_CONTABILIDAD,CODIGO_TIPO_REGIMEN,fecha_actualizacion,CONTACTO_FINANCIERO,TELEFONO_FINANCIERO,CORREO_FINANCIERO,REPRESENTANTE_LEGAL,nueva_identificacion)
                values('01','".$_POST['no_cliente']."','".$_POST['no_sub_cliente']."','".$_POST['rucKey']."','". 
                $_POST['nombre']."','".$_POST['nomComercial']."','".$_POST['razonSocial']."','".$_POST['lstTipoIdent']. 
                "','".$desc_tipo_ident."','".$regimen."','".$_POST['direccionPrincipal']. 
                "','".$_POST['condTrib']."','".$_POST['descCondTrib']."','".
                $tipoContribuyente."','".$_POST['contrEsp']."','".$_POST['divComercial']. 
                "','".$_POST['estado']."','".$_POST['estadoLocal']."','".$_POST['telContactoC']."','". 
                $_POST['correoContactoC']."','". $_POST['nomContactoC']."','".$_POST['oblContabilidad']. 
                "','".$_POST['tipoRegimen']."',current_timestamp(),'".$_POST["nomContactoF"]."','".
                $_POST["telContactoF"]."','".$_POST["correoContactoF"]."','".$_POST["repLegal"]."','".$_POST['ruc']."')";

                //Le pedimos al modelo todos los items
                $listado = $items->actualizaDatos($_POST['rucKey'],$sql);

                //Finalmente presentamos nuestra plantilla
                if($listado->rowCount()>0){
                    //Pasamos a la vista toda la información que se desea representar
                    $data['mensajeOk'] = 'Se actualizó la información exitosamente';   
                    unset($_POST);  
                    $this->view->show("home.php", $data);
                }
                else{
                    $listado = $items->consultaIdentificacion($_POST['rucKey']);
        
                    $data['listado'] = $listado;     
                    $data['mensaje']='No se pudo actualizar la información en nuestra base de datos, favor intentar más tarde.';
                    
                    $this->view->show("frmActualizacion.php", $data);
                }
           }
           else{
                $data='';
                unset($_POST);
                unset($_GET);
                $this->view->show("home.php", $data);               
           }
        }  
        else{
            $data='';
            $this->view->show("home.php", $data);
        }
    }
}
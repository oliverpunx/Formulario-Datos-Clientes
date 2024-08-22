<?php
class CorreoController{
    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }
 
    public function index()
    {
        //Incluye el modelo que corresponde
        require 'models/ClientesModel.php';
        $actualiza= new ClientesModel();

        $busca=$actualiza->consultaCliente($_GET['ruc']);

        if ($busca->rowCount()>0){
            require 'models/CorreosModel.php';
  
            //Creamos una instancia de nuestro "modelo"
            $items = new CorreosModel();
    
            //genera token
            require 'libs/Token.php';
            $miToken=new Token();
            $valor=$miToken->genAleatorio();
            $envio=False;
            
            if (!empty($valor)){
                $envio = $items->enviaCorreo('miguel.lopez@lhenriques.com',$_GET['mail'],'L Henriques - Actualización de Datos',$valor);
            }
    
            //Finalmente presentamos nuestra plantilla
            if($envio){
              //Pasamos a la vista toda la información que se desea representar
              $claveAcceso=$miToken->encrypt_decrypt('encrypt',$valor);
    
              $result=$actualiza->actualizaClave($_GET['ruc'],$claveAcceso,$_GET['mail']);
              $data= array("enviado"=>"No se pudo autorizar la clave de acceso. Por favor, envíe una nueva clave.");

              if($result->rowCount()>0){
                $data= array("enviado"=>"Se envió un codigo de acceso al correo indicado.");
              }
            }
            else{
                $data= array("enviado"=>"No se pudo enviar la clave de acceso.");
            }           
        }
        else{
          $data= array("enviado"=>"Cliente no registrado.");
        }
        
        $respuesta=json_encode($data);
        echo $respuesta;
        //$this->view->show("home.php", $data);
    }
}
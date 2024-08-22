<?php
class FrmdatosController{
    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }
 
    public function index()
    {
        //Incluye el modelo que corresponde
        require 'models/ClientesModel.php';
 
        //Creamos una instancia de nuestro "modelo"
        $items = new ClientesModel();
 
        //Le pedimos al modelo todos los items
        require 'libs/Token.php';
        $miToken=new Token();
        $clave=$miToken->encrypt_decrypt('encrypt',$_POST['codigo']);
        $listado = $items->consultaClienteClave($_POST['ruc'],$clave);
 
        //Finalmente presentamos nuestra plantilla
        if($listado->rowCount()>0){
          //Pasamos a la vista toda la información que se desea representar
          $data['listado'] = $listado;            
          $this->view->show("frmActualizacion.php", $data);
        }
        else{
            $data['mensaje']='Clave de acceso o # de identificación incorrecta.';
            $data['link']='<a href="#" onclick="backPage();">Ingresar otra vez la clave</a>';
            $this->view->show("home.php", $data);
        }
    }
}
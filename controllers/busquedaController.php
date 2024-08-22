<?php
class BusquedaController{
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
        
        try{
            $busca=$actualiza->consultaCliente($_GET['ruc']);

            if ($busca->rowCount()>0){
                $data= array("mensaje"=>"Ok");
                $data=json_encode($data);                      
            }
            else{
              $data= array("mensaje"=>"No");
              $data=json_encode($data);
            }
        }
        catch(Exception $error){
            $data= array("mensaje"=>"No","msgError"=>$error->getMessage());
            $data=json_encode($data);
        }
        finally{
            echo $data;
        }
        
    }
}
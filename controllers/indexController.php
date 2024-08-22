<?php
class IndexController{
    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }
 
    public function index()
    {
        $data='';
        $this->view->show("home.php", $data);
    }
 
    public function agregar()
    {
        echo 'Aquí incluiremos nuestro formulario para insertar items';
    }
}
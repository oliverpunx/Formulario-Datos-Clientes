<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);

class ClientesModel{
    protected $db;
 
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = Conexion::singleton();
    }

    public function consultaCliente($ruc)
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM clientes where no_cia="01" and identificacion="'.$ruc.'" and ind_actualizado="N"');
        $consulta->execute();
        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }   

    public function consultaIdentificacion($ruc)
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM clientes where no_cia="01" and identificacion="'.$ruc.'"');
        $consulta->execute();
        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }     
      
    public function consultaClienteClave($ruc,$clave)
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM clientes where no_cia="01" and identificacion="'.$ruc.'" and ind_actualizado="N" and CLAVE_ACCESO="'.$clave.'"');
        $consulta->execute();
        //devolvemos la colección para que la vista la presente.
        return $consulta;
    }

    public function actualizaClave($ruc,$clave,$correo){
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('update clientes set clave_acceso="'.$clave.'",CORREO_SOLICITA_ACTUALIZACION ="'.$correo.'" where no_cia="01" and identificacion="'.$ruc.'" and ind_actualizado="N"');
        $consulta->execute();
        //devolvemos la colección para que la vista la presente.
        return $consulta;        
    }

    public function actualizaDatos($ruc,$sql){
           $consulta = $this->db->prepare($sql);
           $consulta->execute(); 

           $consulta = $this->db->prepare('update clientes set ind_actualizado="S",fecha_actualizacion=CURRENT_TIMESTAMP(),clave_acceso=null where no_cia="01" and identificacion="'.$ruc.'" and ind_actualizado="N"');
           $consulta->execute();   

           return $consulta;
    }

}
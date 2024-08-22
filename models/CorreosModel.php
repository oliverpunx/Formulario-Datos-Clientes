<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
// Incluir la libreria PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class CorreosModel{
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = Conexion::singleton();
    }

    function enviaCorreo($from,$to,$subject,$clave){
        require 'libs/PHPMailer/src/Exception.php';
        require 'libs/PHPMailer/src/PHPMailer.php';
        require 'libs/PHPMailer/src/SMTP.php';        

        $mail = new PHPMailer;
        
        //$mail->SMTPDebug    = 3;
        
        $mail->IsSMTP();
        $mail->Host = 'localhost';   /*Servidor SMTP*/																		
        $mail->SMTPSecure = '';   /*Protocolo SSL o TLS*/
        $mail->Port = 25;   /*Puerto de conexión al servidor SMTP*/
        $mail->SMTPAuth = false;   /*Para habilitar o deshabilitar la autenticación*/
        $mail->Username = '';   /*Usuario, normalmente el correo electrónico*/
        $mail->Password = '';   /*Tu contraseña*/
        $mail->From = $from;   /*Correo electrónico que estamos autenticando*/
        $mail->FromName = 'Notificaciones LH';   /*Puedes poner tu nombre, el de tu empresa, nombre de tu web, etc.*/
        $mail->CharSet = 'UTF-8';   /*Codificación del mensaje*/        

        $headers="From: ".$from;

        $mail->ClearAllRecipients( );

        $mail->AddAddress($to);
        //$mail->AddCC("concopia1@email.com");
                
        $mail->IsHTML(true);  //podemos activar o desactivar HTML en mensaje
        $mail->Subject = $subject;
        
        $msg = "<h2 align='center'>Actualización de datos</h2>
        <p align='justify'>Se ha generado su clave de acceso para acceder al formulario de actualización de datos</p>
        <h3 align='center'>".$clave."</h3>
        ";
        
        $mail->Body    = $msg;
        $mail->Send();

        return true;
    }     
    
    
}

    

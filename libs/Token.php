<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

class Token {
    // Function encriptado|desencriptado
    function encrypt_decrypt($action, $string) :string {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'tu_clave_secreta';
        $secret_iv = 'salt_secreto';
        // hash
        $key = hash('sha256', $secret_key);    
        // iv - encrypt method AES-256-CBC expects 16 bytes 
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        
        return $output;
    }

    function genAleatorio(){
             $valor=rand(10000,99999);

             return $valor;
    }

}
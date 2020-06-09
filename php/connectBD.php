<?php
    $local = "34.95.176.55:3306";
    $usuario_bd = "root";
    $senha_bd = "fernandes2401";
    $base = "Banco_Fernandes";
    
    $connect = new mysqli($local, $usuario_bd, $senha_bd, $base);
    
    if($connect -> connect_error == true){
        die("Erro.  ".$connect-> connect_error);
    }
    
?>

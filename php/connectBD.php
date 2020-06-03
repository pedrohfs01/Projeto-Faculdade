<?php
    $local = "localhost";
    $usuario_bd = "root";
    $senha_bd = "";
    $base = "exemplo";
    
    $connect = new mysqli($local, $usuario_bd, $senha_bd, $base);
    
    if($connect -> connect_error == true){
        die("Erro.  ".$connect-> connect_error);
    }
?>

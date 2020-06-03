<?php
    session_start();
    require("connectBD.php");
    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    
    if(isset($_POST["registrar"])){
        if(!strstr($email, "@", true)){
            msgJS("Email inválido.");
            voltaRegistro();
        }
        else if(strlen($usuario) <= 5){
            msgJS("Usuário com menos de 5 caractéres.");
            voltaRegistro();
        }
        else if(strlen($senha) <= 6){
            msgJS("Senha muito curta. Adicione mais caractéres.");
            voltaRegistro();
        }
        else{
            
            $procurar = "SELECT * FROM usuario WHERE nome='$usuario' OR email='$email'";
            $res = $connect ->query($procurar);
            
            if($res -> num_rows > 0){
                msgJS("Usuário já cadastrado.");
                voltaRegistro();
            }
            
            $registro = "INSERT INTO usuario(nome, email, senha) VALUES ('$usuario', '$email', '$senha');";

            if($connect -> query($registro) == true){
                msgJS("Usuário Cadastrado com sucesso!");
                echo "<script>window.location.href = '../index.html';</script>";
            }
            else{
                msgJS("ERRO");
                voltaRegistro();
            }
        }
        
        
    }
    function voltaRegistro(){
        echo "<script>window.location.href = '../registro.html';</script>";
    }
    function msgJS($msg){
        echo "<script>alert('$msg')</script>";
    }
?>

<?php 
    require("connectBD.php");
    session_start();
    
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    
    if(isset($_POST["entrar"])){
        if(empty($usuario)){
            msgJS("Campo usuário vázio.");
        }
        else if(empty($senha)){
            msgJS("Campo senha vázio.");
        }
        else{
            $procura = "SELECT * FROM usuario WHERE nome = '$usuario' AND senha = '$senha';";
            $res = $connect -> query($procura);

            if($res -> num_rows > 0){
                msgJS("Usuário Logado!");
                echo "<script>window.location.href = 'acesso.php';</script>";
                $_SESSION["usuario"] = $usuario;
                $_SESSION["senha"] = $senha;
            }
            else{
                msgJS("Usuário ou senha inválidos.");
                voltaLogin();
                session_unset();
                session_destroy();
            }
        }
    }
    function voltaLogin(){
        echo "<script>window.location.href = '../index.html';</script>";
    }
    function msgJS($msg){
        echo "<script>alert('$msg')</script>";
    }
?>
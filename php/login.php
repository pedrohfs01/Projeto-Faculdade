<?php 
    require("connectBD.php");
    session_start();
    
    $cpf = $_POST["cpf"];
    $senha = $_POST["senha"];
    
    if(isset($_POST["entrar"])){
        if(empty($cpf)){
            msgJS("Campo usuário vázio.");
        }
        else if(empty($senha)){
            msgJS("Campo senha vázio.");
        }
        else{
            $procura = "SELECT * FROM cliente WHERE cpf = '$cpf' AND senha = '$senha';";
            $res = $connect -> query($procura);

            if($res -> num_rows > 0){
                msgJS("Usuário Logado!");
                $_SESSION["cpf"] = $cpf;
                $_SESSION["senha"] = $senha;
                echo "<script>window.location.href = 'acesso.php';</script>";
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
        echo "<script>window.location.href = '../login.html';</script>";
    }
    function msgJS($msg){
        echo "<script>alert('$msg')</script>";
    }
?>
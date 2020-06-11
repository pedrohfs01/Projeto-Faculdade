<?php
session_start();
if(isset($_SESSION["cpf"]) && isset($_SESSION["senha"])){
    echo "<script>"
            . "alert('Você está logado já!');"
            . "window.location.href = 'acesso.php';"
            . "</script>";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Fernandes Bank's</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="./image/png" href="../images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->
        <script>
            function mascara(i){

            var v = i.value;

            if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
                    i.value = v.substring(0, v.length-1);
                    return;
            }

            i.setAttribute("maxlength", "14");
                    if (v.length == 3 || v.length == 7) i.value += ".";
                    if (v.length == 11) i.value += "-";

            }
            
        </script>
</head>
<body >
	
	<div class="limiter" >
		<div class="container-login100" style="background-image: url('../images/back.png');">
			<div class="wrap-login100" style="background-color:rgba(201, 137, 0, 0.5)">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="post">
					<span class="login100-form-title" style="background-color: rgba(0, 0, 0, 0.322); font-family: FreeMono, monospace;" >
						Recuperar sua senha.
                        </span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Por favor entre com seu CPF">
						<input class="input100" type="text" oninput="mascara(this)" name="cpf" placeholder="Seu CPF">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Digite seu nome completo">
						<input class="input100" type="text" name="nome" placeholder="Digite seu nome completo">
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Digite o nome da sua mãe completo">
						<input class="input100" type="text" name="nomeMae" placeholder="Digite o nome da sua mãe: ">
						<span class="focus-input100"></span>
					</div>
                                        <div class="wrap-input100 validate-input m-b-10" data-validate = "Digite sua nova senha:">
						<input class="input100" type="text" name="novaSenha" placeholder="Digite sua nova senha: ">
						<span class="focus-input100"></span>
					</div>
					<br>

					<div class="container-login100-form-btn">
						<input type="submit" value="Recuperar" name="recuperar" class="login100-form-btn">
					</div>

					<div class="flex-col-c p-t-50 p-b-40">
						<a href="../login.html" class="txt3" style="color: white;">
							<u>Lembrou a senha? Clique aqui para voltar.</u>
					   </a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
            require("connectBD.php");
            if(isset($_POST["recuperar"])){
                $cpf = $_POST["cpf"];
                $nome = $_POST["nome"];
                $nomeMae = $_POST["nomeMae"];
                $senha = $_POST["novaSenha"];
                if(strlen($senha) <= 5){
                    echo "<script>alert('Senha fraca demais.');</script>";
                    echo "<script>window.location.href = 'esqueceusenha.php';</script>";
                }
                $procura = "SELECT senha, email FROM cliente WHERE cpf = '$cpf' AND nome = '$nome' AND nomeMae = '$nomeMae';";
                $res = $connect -> query($procura);
                if($res -> num_rows > 0){
                    $atualizar = "UPDATE cliente SET senha = '$senha' WHERE cpf = '$cpf';";
                    if($connect -> query($atualizar) == TRUE){
                        echo "<script>alert('Atualizado com sucesso!');</script>";
                        echo "<script>window.location.href = '../login.html';</script>";
                    }
                    else{
                        echo "<script>alert('ERRO ao recuperar');</script>";
                    }
                }
                else{
                    echo "<script>alert('Dados não encontrados.');</script>";
                }
            }
        ?>
	
<!--===============================================================================================-->
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/daterangepicker/moment.min.js"></script>
	<script src="../vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>

</body>
</html>
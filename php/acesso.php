<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
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
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="post">
					<span class="login100-form-title">
                                            Seja bem vindo!<br>Mapa da sua região de Sobradinho!
					</span>
                                    	<iframe
                                            width="400"
                                            height="500"
                                            frameborder="0" style="border:0"
                                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCPwViqS2I7fdYiqZYTCN3OJxogXXF4_C4
                                            &q=Sobradinho+DF" allowfullscreen>
                                        </iframe><br><br>
                                        <div class="container-login100-form-btn">
                                                    <input type="submit" value="Sair" name="sair" class="login100-form-btn">
                                        </div><br>
				</form>
			</div>
		</div>
	</div>
	
        <?php
            session_start();
            if(!isset($_SESSION["usuario"]) && !isset($_SESSION["senha"])){
                session_unset();
                session_destroy();
                echo "<script>"
                        . "alert('Essa página só pode ser acessada logada!');"
                        . "window.location.href = '../index.html';"
                        . "</script>";
            }
            if(isset($_POST["sair"])){
                echo "<script>alert('Saindo da conta.');"
                . "window.location.href='../index.html';</script>";
                session_unset();
                session_destroy();
            }
        ?>

</body>
</html>

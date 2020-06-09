<?php
session_start();
require("connectBD.php");
if(!isset($_SESSION["cpf"]) && !isset($_SESSION["senha"])){
    session_unset();
    session_destroy();
    echo "<script>"
            . "alert('Entre na sua conta!');"
            . "window.location.href = '../login.html';"
            . "</script>";
}

$cpf = $_SESSION["cpf"];
$sql = "select cl.nome, co.agencia, co.numConta, co.saldo, co.lim_credito, co.lim_credito_max from "
        . "cliente cl inner join conta co on cl.cpf = co.cpf where co.cpf = '$cpf';";
$result = $connect -> query($sql);
if (mysqli_num_rows($result) > 0) {
    while($dados = mysqli_fetch_assoc($result)){
        $nome = $dados["nome"];
        $agencia = $dados["agencia"];
        $numConta = $dados["numConta"];
        $saldo = $dados["saldo"];
        $limCredito = $dados["lim_credito"];
        $limCreditoMax = $dados["lim_credito_max"];
    }
}
else{
    echo "alert('Erro, entre novamente!');"
       . "window.location.href = '../login.html';";
}

?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Fernandes Bank's</title>
 <!-- Meta-Tags -->
 <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
	<meta name="keywords" content="Fernandes Bank's, Banco Fernandes">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
		}
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
    <!-- //Meta-Tags -->

	<!-- css files -->
	<link href="../css/font-awesome2.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="../css/style2.css" rel="stylesheet" type="text/css" media="all"/>
	<!-- //js src -->
	<!-- google fonts -->

	<!-- //google fonts -->

</head>
<body>

<div class="signupform">
	<div class="container">
		<fieldset style= "background-color: white; max-width:500px;
		padding:16px;  width: 50%; margin: 0px auto;
		border:2px solid green;
                -moz-border-radius:8px;
                -webkit-border-radius:8px;
                border-radius:8px;"><h1 style="text-align: center; font-size: 45px;
		color: Black;
		font-weight: 700;
		font-family: Source Sans Pro;">Serviços Bancários</h1></fieldset>
		<!-- main content -->
		<div class="agile_info">
			<div class="w3l_form">
				<div class="left_grid_info">
					<b><h1 id="saldo" style="color: gray">Saldo: R$ 0,00</h1></b>
					<h2 id="agencia" style="color: gray">Agência: </h2>
					<h2 id="numConta" style="color: gray">N° Conta: </h2>
                                        <h2 id="nomeT" style="color: gray">Nome Titular: </h2>
                                        <h2 id="limCreditoMax" style="color: gray">Limite: </h2>
                                        <h2 id="limCredito" style="color: gray">Limite Disponível: </h2>
                                        <form method="post">
                                        <br><br><button class="btn btn-danger btn-block" name="sair" type="submit">Sair</t></button>
                                        <button class="btn btn-danger btn-block" name="cancelar" type="submit">Cancelar a conta</t></button>
                                        </form>
					<br><br><br><br>
					<fieldset><p>Deseja fazer qual tipo de transação? <br>(Sacar ou Depositar)</p><br>
					<form method="post">
						<div class="input-group">
							<span class="fa fa-money" aria-hidden="true"></span>
							<input name="valor2" type="text" id="dinheiro" placeholder="(R$0 - R$999,99)" required="">
						</div><br><br>
							<button class="btn btn-danger btn-block" name="sacar" type="submit">Sacar</button >
							<button class="btn btn-danger btn-block" name="depositar" type="submit">Depositar</button >
					</form></fieldset>

				</div>
			</div>
			<div class="w3_info">
				<h1>Transfira dinheiro para outra conta</h1>
				<p>Coloque os dados abaixo:</p>
				<form action="#" method="post">
					<label>Agência: </label>
					<div class="input-group2">
						<input name="agencia" type="text" maxlength="4" placeholder="Entre com a agência" required=""
						onkeypress="return event.charCode >= 48 && event.charCode <= 57">
					</div>
					<label>Número da conta: </label>
					<div class="input-group2">
						<input name="numConta" type="text" maxlength="5"placeholder="Entre com o número da conta." required=""
						onkeypress="return event.charCode >= 48 && event.charCode <= 57">
					</div>
					<label>CPF: </label>
					<div class="input-group2" >
						<input name="cpf" oninput="mascara(this)" type="text" placeholder="Entre com o cpf do beneficiado." required="">
					</div>
					<label>Valor: </label>
					<div class="input-group2">
						<span class="fa fa-money" aria-hidden="true"></span>
						<input name="valor" type="text"class="dinheiro"placeholder="(R$0 - R$999,99)" required="">
					</div>
						<button class="btn btn-danger btn-block" name="transferir" type="submit">Transferir</button >
				</form>
			</div>
		</div>
		<!-- //main content -->
	</div>
</div>
	<script type="text/javascript">
    $("#dinheiro, .dinheiro").mask("000.00");
    </script>

</body>
</html>
<?php
if(isset($_POST["sair"])){
    echo "<script>alert('Saindo da conta.');"
    . "window.location.href='../index.html';</script>";
    session_unset();
    session_destroy();
}
if(isset($_POST["cancelar"])){
    $sql = "DELETE FROM conta WHERE cpf = '$cpf'";
    if($connect -> query($sql) == true){
        $sql = "DELETE FROM cliente WHERE cpf = '$cpf'";
        if($connect -> query($sql) == true){
            msgJS("Conta cancelada com sucesso.");
            echo "<script>window.location.href = '../index.html';</script>";
            session_unset();
            session_destroy();
        }
        else{
            echo"ERRO: ".$sql."<br>".$connect -> error;
        }
    }
    else{
        echo"ERRO: ".$sql."<br>".$connect -> error;
    }
}
if(isset($_POST["sacar"])){
    $valor = $_POST["valor2"];
    $valorTotal = $saldo + $limCredito;
    if($valor > $valorTotal){
        msgJS("Saldo e Limite insuficiente.");
    }
    else if($valor > $saldo){//Se o valor for maior que o saldo, irá retirar do limite!!!
        $valorC = $valor - $saldo;//Valor menos o saldo oque sobrar vai tirar do limite do crédito e deixar 0 no saldo
        $valorC = $limCredito - $valorC;//O valor liquido do limite para setar
        $sql = "UPDATE conta SET lim_credito = $valorC, saldo = 0 WHERE cpf = '$cpf';";
        if($connect -> query($sql) == true){
            msgJS("Saque realizado com sucesso. Limite atualizado.");
            voltaPagina();
        }
        else{
            msgJS("Erro ao sacar, tente novamente mais tarde.");
        }
    }
    else{
        $valorC = $saldo - $valor;//Tirar o valor normal do saldo
        $sql = "UPDATE conta SET saldo = $valorC WHERE cpf = '$cpf';";
        if($connect -> query($sql) == true){
            msgJS("Saque realizado com sucesso.");
            voltaPagina();
        }
        else{
            msgJS("Erro ao sacar, tente novamente mais tarde.");
        }
    }
}
if(isset($_POST["depositar"])){
    $valor = $_POST["valor2"];
    if($limCredito < $limCreditoMax){//Se o Limite estiver menor que o limite máximo!
        $valorRestante = $limCreditoMax - $limCredito;//Valor que sobra para chegar no máximo
        $valorDeTeste = $limCredito + $valor;//Valor total para ver está acima do limite 
        if($valorDeTeste < $limCreditoMax){ //Verifica se o valor está no limite ou não do limite de crédito 
            $sql = "UPDATE conta SET lim_credito = $valorDeTeste WHERE cpf = '$cpf';";//QUERY
            if($connect -> query($sql) == true){
                msgJS("Depositado. Limite atualizado.");//Se estiver menor o valor que o limite máximo então n precisará tirar do saldo
                voltaPagina();
            }
            else{
                msgJS("Erro ao depositar, tente novamente mais tarde.");
            }
        }
        else{
            $valorD = $valor - $valorRestante;//Pega o valor menos oque resta do limite(vai botar 500 no lim credito)
            $valorD += $saldo; //O valor que ficará no saldo
            $sql = "UPDATE conta SET lim_credito = $limCreditoMax, saldo = $valorD WHERE cpf = '$cpf';";
            if($connect -> query($sql) == true){
                msgJS("Depositado. Limite e Saldo atualizado.");
                voltaPagina();
            }
            else{
                msgJS("Erro ao depositar, tente novamente mais tarde.");
            }
        }
    }
    else{
        $valorD = $saldo + $valor;//Deposita o valor direto no saldo se n tiver débito no limite de crédito.
        $sql = "UPDATE conta SET saldo = $valorD WHERE cpf = '$cpf'";
        if($connect -> query($sql) == true){
            msgJS("Depositado. Saldo atualizado.");
            voltaPagina();
        }
        else{
            msgJS("Erro ao depositar, tente novamente mais tarde.");
        }
    }
}
if(isset($_POST["transferir"])){
    $ag = $_POST["agencia"];
    $nConta = $_POST["numConta"];
    $cpfDes = $_POST["cpf"];
    $valor = $_POST["valor"];
    $saldoTotal = $saldo + $limCredito;
    if($valor > $saldoTotal){
        msgJS("Saldo e Limite insuficiente.");
    }
    else{
        $sql = "SELECT * FROM conta WHERE agencia = '$ag' AND numConta = '$nConta' AND cpf = '$cpfDes';";
        $res = $connect -> query($sql);
        if(mysqli_num_rows($res) > 0) {
            while($dados = mysqli_fetch_assoc($res)){
                $saldoDes = $dados["saldo"];
                $limCreditoDes = $dados["lim_credito"];
                $limCreditoMaxDes = $dados["lim_credito_max"];
            }
            if($valor > $saldo){
                $valorC = $valor - $saldo;
                $valorC = $limCredito - $valorC;
                $sql = "UPDATE conta SET saldo = 0, lim_credito = $valorC WHERE cpf = '$cpf';";
                $connect -> query($sql);
            }
            else{
                $valorC = $saldo - $valor;
                $sql = "UPDATE conta SET saldo = $valorC WHERE cpf = '$cpf'";
                $connect -> query($sql);
            }
            if($limCreditoDes < $limCreditoMaxDes){
                $valorRestante = $limCreditoMaxDes - $limCreditoDes;
                $valorDeTeste = $limCreditoDes + $valor;
                if($valorDeTeste < $limCreditoMaxDes){
                    $sql = "UPDATE conta SET lim_credito = $valorDeTeste WHERE cpf = '$cpfDes';";
                    if($connect -> query($sql) == true){
                        msgJS("Transferido. Limite atualizado.");
                        voltaPagina();
                    }
                    else{
                        msgJS("Erro ao transferir, tente novamente mais tarde.");
                    }
                }
                else{
                    $valorD = $valor - $valorRestante;
                    $valorD += $saldoDes;
                    $sql = "UPDATE conta SET lim_credito = $limCreditoMaxDes, saldo = $valorD WHERE cpf = '$cpfDes';";
                    if($connect -> query($sql) == true){
                        msgJS("Transferido. Limite e Saldo atualizado.");
                        voltaPagina();
                    }
                    else{
                        msgJS("Erro ao transferir, tente novamente mais tarde.");
                    }
                }
            }
            else{
                $valorD = $saldoDes + $valor;
                $sql = "UPDATE conta SET saldo = $valorD WHERE cpf = '$cpfDes';";
                if($connect -> query($sql) == true){
                    msgJS("Transferido. Saldo atualizado.");
                    voltaPagina();
                }
                else{
                    msgJS("Erro ao transferir, tente novamente mais tarde.");
                }
            }
        
        } 
        else {
            msgJS("Dados incorretos.");
        }
    }
}
function voltaPagina(){
    echo "<script>window.location.href = 'acesso.php';</script>";
}
function msgJS($msg){
    echo "<script>alert('$msg');</script>";
}
echo "<script>"
        . "var saldo = document.getElementById('saldo');"
        . "var nome = document.getElementById('nomeT');"
        . "var agencia = document.getElementById('agencia');"
        . "var numConta = document.getElementById('numConta');"
        . "var limCredito = document.getElementById('limCredito');"
        . "saldo.innerHTML = 'Saldo: R$ $saldo';"
        . "nome.innerHTML = 'Nome: $nome';"
        . "agencia.innerHTML = 'Agência: $agencia';"
        . "limCreditoMax.innerHTML = 'Limite: R$ $limCreditoMax';"
        . "numConta.innerHTML = 'N° Conta: $numConta';"
        . "limCredito.innerHTML = 'Limite Disponível: R$ $limCredito';"
        . "</script>";
?>

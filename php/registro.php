<?php
    session_start();
    require("connectBD.php");
    
    
if(isset($_POST["registrar"])){
    $nome = $_POST["nome"];
    $nomeMae = $_POST["nomeMae"];
    $genero = $_POST["genero"];
    $cpf = $_POST["cpf"];
    $rg = $_POST["rg"];
    $uf = $_POST["uf"];
    $dtNasc = $_POST["dataNascimento"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    if(!strstr($email, "@", true)){
        msgJS("Email inválido.");
        voltaRegistro();
    }
    else if(validaCPF($cpf) == false){
        msgJS("CPF Inválido.");
        voltaRegistro();
    }
    else if(strlen($senha) <= 5){
        msgJS("Senha muito curta. Adicione mais caractéres.");
        voltaRegistro();
    }
    else{

        $procurar = "SELECT * FROM cliente WHERE cpf='$cpf'";
        $res = $connect ->query($procurar);

        if($res -> num_rows > 0){
            msgJS("CPF já cadastrado.");
            voltaRegistro();
        }

        $registro = "INSERT INTO cliente(cpf, nome, nomeMae, genero, RG, UF, dataNascimento, telefone, endereco, email, senha)"
                . " VALUES ('$cpf', '$nome', '$nomeMae', '$genero', '$rg', '$uf', '$dtNasc', '$telefone', '$endereco', '$email', '$senha');";
        if($connect -> query($registro) == true){
            switch($uf){
                case "AC":
                    $agencia = "1000";
                    break;
                case "AL":
                    $agencia = "1001";
                    break;
                case "AP":
                    $agencia = "1002";
                    break;
                case "AM":
                    $agencia = "1003";
                    break;
                case "BA":
                    $agencia = "1004";
                    break;
                case "CE":
                    $agencia = "1005";
                    break;
                case "DF":
                    $agencia = "1006";
                    break;
                case "ES":
                    $agencia = "1007";
                    break;
                case "GO":
                    $agencia = "1008";
                    break;
                case "MA":
                    $agencia = "1009";
                    break;
                case "MS":
                    $agencia = "1010";
                    break;
                case "MT":
                    $agencia = "1011";
                    break;
                case "MG":
                    $agencia = "1012";
                    break;
                case "PA":
                    $agencia = "1013";
                    break;
                case "PB":
                    $agencia = "1014";
                    break;
                case "PR":
                    $agencia = "1015";
                    break;
                case "PE":
                    $agencia = "1016";
                    break;
                case "PI":
                    $agencia = "1017";
                    break;
                case "RJ":
                    $agencia = "1018";
                    break;
                case "RN":
                    $agencia = "1019";
                    break;
                case "RS":
                    $agencia = "1020";
                    break;
                case "RO":
                    $agencia = "1021";
                    break;
                case "RR":
                    $agencia = "1022";
                    break;
                case "SC":
                    $agencia = "1023";
                    break;
                case "SP":
                    $agencia = "1024";
                    break;
                case "SE":
                    $agencia = "1025";
                    break;
                case "TO":
                    $agencia = "1026";
                    break;
            }
            $bool = false;
            while($bool == false){
                $numConta = rand(10000, 99999);
                $teste = "SELECT * FROM contas WHERE numConta = '$numConta'";
                if($teste -> num_rows > 0){
                }else{ $bool = true;}
            }  
            $abrirConta = "INSERT INTO conta(numConta, agencia, saldo, cpf, lim_credito, lim_credito_max) VALUES"
                        . "('$numConta', '$agencia', 50, '$cpf', 500, 500);";
            if($connect -> query($abrirConta) == true){
                msgJS("Cadastro realizado com sucesso!");
                echo "<script>window.location.href = '../login.html';</script>";
            }
            else{
                msgJS("Erro ao cadastrar.2");
                voltaRegistro();
            }
        }
        else{
            msgJS("Erro ao cadastrar.1");
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
    function validaCPF($cpfAJ = null) {
        
	// Verifica se um número foi informado
	if(empty($cpfAJ)) {
		return false;
	}
        // Elimina possivel mascara
	$cpfAJ = preg_replace("/[^0-9]/", "", $cpfAJ);
	$cpfAJ = str_pad($cpfAJ, 11, '0', STR_PAD_LEFT);
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($cpfAJ) != 11) {
		return false;
	}
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cpfAJ == '00000000000' || 
		$cpfAJ == '11111111111' || 
		$cpfAJ== '22222222222' || 
		$cpfAJ == '33333333333' || 
		$cpfAJ == '44444444444' || 
		$cpfAJ == '55555555555' || 
		$cpfAJ == '66666666666' || 
		$cpfAJ == '77777777777' || 
		$cpfAJ == '88888888888' || 
		$cpfAJ == '99999999999') {
		return false;
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   
		
		for ($t = 9; $t < 11; $t++) {
			
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpfAJ{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpfAJ{$c} != $d) {
				return false;
			}
		}

		return true;
	}
    }
?>

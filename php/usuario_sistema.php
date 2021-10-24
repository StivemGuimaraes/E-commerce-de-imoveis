<?php
  
include "conexao.php";

$email = $_POST["email"];
$senha = $_POST["senha"];
$nome = $_POST["nome"];
$sobrenome = $_POST["Sobrenome"];
$cpf = $_POST["cpf"];
$rg = $_POST["rg"];
$data_nasci = $_POST["data"];
$tel = $_POST["tel"];
$sexo = $_POST["sexo"];
$botao = $_POST["botao"];


if ($botao == "incluir") 
{
	

	try{
	    $Comando=$conexao->prepare("insert into usuario(email,senha,nome,sobrenome,cpf,rg,data_nasci,sexo,fk_contato)values(?,?,?,?,?,?,?,?,?);");
		$Comando->bindParam(1,$email);
		$Comando->bindParam(2,$senha);
		$Comando->bindParam(3,$nome);
		$Comando->bindParam(4,$sobrenome);
		$Comando->bindParam(5,$cpf);
		$Comando->bindParam(6,$rg);
		$Comando->bindParam(7,$data_nasci);
		$Comando->bindParam(8,$sexo);
		$Comando->bindParam(9,$tel);

		$Comando->execute();
		if ($Comando->rowCount()>0) 
		{
		  $retorno = "Cadastrando com sucesso";
		}
		else 
		{
		    $retorno = "O cadastrando deu erro";
		}
    }
	catch(PDOExecption $Erro)
	{
    	$retorno = "deu erro mano " . $Erro->getMessage();
	}

   echo $retorno;
}

if ($botao == "deletar") {
	try{
	    $Comando=$conexao->prepare("delete from usuario where cpf=?");
		$Comando->bindParam(1,$cpf);

		$Comando->execute();
		if ($Comando->rowCount()>0) 
		{
		  $retorno = "exclusão da conta feito com sucesso";
		}
		else 
		{
		    $retorno = "exclusão deu erro";
		}
    }
	catch(PDOExecption $Erro)
	{
    	$retorno = "deu erro mano " . $Erro->getMessage();
	}
	echo $retorno;
}
if ($botao == "consultar") {
	try{
	    $Comando=$conexao->prepare("select * from usuario where cpf=?");
		$Comando->bindParam(1,$cpf);

		$Comando->execute();
		$usuario = $Comando->fetchAll();

		$retorno = json_encode($usuario);
		$cont->query("call contador_usuario(@quan);");
		$quant = $cont->query("select @quan as quantidade")->fetch(PDO::FETCH_ASSOC);
		echo "a quantidade de usuarios são: " . $quant['quantidade'];
		echo $retorno;
    }
	catch(PDOExecption $Erro)
	{
    	$retorno = "deu erro mano " . $Erro->getMessage();
	}
}
if ($botao == "alterar") {
	try{
	    $Comando=$conexao->prepare("update usuario set cpf=? rg=? data_nasci=? sexo=? email=?, senha=?, nome=?, sobrenome=?, fk_contato=? where cpf=?");
		$Comando->bindParam(1,$cpf);
		$Comando->bindParam(2,$rg);
		$Comando->bindParam(3,$data_nasci);
		$Comando->bindParam(4,$sexo);
		$Comando->bindParam(5,$email);
		$Comando->bindParam(6,$senha);
		$Comando->bindParam(7,$nome);
		$Comando->bindParam(8,$sobrenome);
		$Comando->bindParam(9,$tel);
		$Comando->bindParam(10,$cpf);

		$Comando->execute();
		
		if ($Comando->rowCount() > 0) {
			$retorno = "alteração feita com sucesso";
		}
		else{

			$retorno = "falha na alteração";
		}
    }
	catch(PDOExecption $Erro)
	{
    	$retorno = "deu erro mano " . $Erro->getMessage();
	}
	echo $retorno;
}
?>
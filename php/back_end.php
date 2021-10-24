<?php
  
include "conexao.php";

$email = $_POST["email"];
$senha = $_POST["senha"];
$repetir_email = $_POST["repetir_email"];
$repetir_senha = $_POST["repetir_senha"];
$nome = $_POST["nome"];
$sobrenome = $_POST["Sobrenome"];
$cpf = $_POST["cpf"];
$rg = $_POST["rg"];
$data_nasci = $_POST["data"];
$tel = $_POST["tel"];
$sexo = $_POST["sexo"];
$botao = $_POST["botao"];


if ($botao == "Enviar") 
{
	if ($email != $repetir_email) {
		  echo "<script>alert('os emails não são iguais')</script>";
	}
	elseif ($senha != $repetir_senha) {
		  echo "<script>alert('as senhas não são iguais')</script>";
	}
	else{

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
}
   echo $retorno;
}

if ($botao == "Deletar") {
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
if ($botao == "Consultar") {
	try{
	    $Comando=$conexao->prepare("select * from usuario where cpf=?");
		$Comando->bindParam(1,$cpf);

		$Comando->execute();
		$usuario = $Comando->fetchAll();

		$retorno = json_encode($usuario);
		echo $retorno;
    }
	catch(PDOExecption $Erro)
	{
    	$retorno = "deu erro mano " . $Erro->getMessage();
	}
}
if ($botao == "Alterar") {
	try{
	    $Comando=$conexao->prepare("update usuario set email=?, senha=?, nome=?, sobrenome=?, fk_contato=? where cpf=?");
		$Comando->bindParam(1,$email);
		$Comando->bindParam(2,$senha);
		$Comando->bindParam(3,$nome);
		$Comando->bindParam(4,$sobrenome);
		$Comando->bindParam(5,$tel);
		$Comando->bindParam(6,$cpf);

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
}
?>
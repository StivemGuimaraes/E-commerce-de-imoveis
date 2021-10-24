<?php
  
include "conexao.php";

$cep = $_POST["cep"];
$estado = $_POST["estado"];
$cidade = $_POST["cidade"];
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$complemeto = $_POST["complemento"];
$botao = $_POST["botao"];


if ($botao == "incluir") 
{

	try{
	    $Comando=$conexao->prepare("insert into endereco_imovel(cep, estado, cidade, rua, numero, bairro, complemeto)values(?,?,?,?,?,?,?);");
		$Comando->bindParam(1,$cep);
		$Comando->bindParam(2,$estado);
		$Comando->bindParam(3,$cidade);
		$Comando->bindParam(4,$rua);
		$Comando->bindParam(5,$numero);
		$Comando->bindParam(6,$bairro);
		$Comando->bindParam(7,$complemeto);

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
	    $Comando=$conexao->prepare("delete from endereco_imovel where cep=?");
		$Comando->bindParam(1,$cep);

		$Comando->execute();
		if ($Comando->rowCount()>0) 
		{
		  $retorno = "exclusão do endereço feito com sucesso";
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
	    $Comando=$conexao->prepare("select * from endereco_imovel where cep=?");
		$Comando->bindParam(1,$cep);

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
if ($botao == "alterar") {
	try{
	    $Comando=$conexao->prepare("update endereco_imovel set cep=? estado=? cidade=? rua=? numero=?, bairro=?, complemeto=?, where cep=?");
		$Comando->bindParam(1,$cep);
		$Comando->bindParam(2,$estado);
		$Comando->bindParam(3,$cidade);
		$Comando->bindParam(4,$rua);
		$Comando->bindParam(5,$numero);
		$Comando->bindParam(6,$bairro);
		$Comando->bindParam(7,$complemeto);
		$Comando->bindParam(8,$cep);

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
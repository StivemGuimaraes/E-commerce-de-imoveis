<<?php

class iml_sistema
{
	private $descricao;
	private $preco;
	private $foto;

public function setDescricao($descricao)
{
	$this->descricao = $descricao;
}
public function setPreco($preco)
{
	$this->preco = $preco;
}
public function setCodigo($codigo)
{
	$this->codigo = $codigo;
}
public function setFoto($foto)
{
	$this->foto = $foto;
}
	public function incluir()
	{
		include "conexao.php"
	    
	    try{
		    $Comando=$conexao->prepare("insert into imovel(descricao, preco, foto)values(?,?,?);");
			$Comando->bindParam(1,$this->$descricao);
			$Comando->bindParam(2,$this->$preco);
			$Comando->bindParam(3,$this->$foto);
			
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
	    return $retorno;
	}

	public function exclusao()
	{
		include "conexao.php";

	  try{
		    $Comando=$conexao->prepare("delete from imovel where codigo=?");
			$Comando->bindParam(1,$this->$codigo);

			$Comando->execute();
			if ($Comando->rowCount()>0) 
			{
			  $retorno = "exclusão do imovel feito com sucesso";
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

		return $retorno;
	}

	public function consulta()
	{
		include "conexao.php";

		try{
	    $Comando=$conexao->prepare("select * from imovel where codigo=?");
		$Comando->bindParam(1,$codigo);

		$Comando->execute();
		$imovel = $Comando->fetchAll();

		$retorno = json_encode($imovel);
		$cont->query("call contador_imovel(@quan);");
		$quant = $cont->query("select @quan as quantidade")->fetch(PDO::FETCH_ASSOC);
		return "a quantidade de imoveis são: " . $quant['quantidade'];
		return $retorno;
    }
	catch(PDOExecption $Erro)
	{
    	$retorno = "deu erro mano " . $Erro->getMessage();
	}

	}

	public function alterar()
	{
		include "conexao.php";

		try{
	    $Comando=$conexao->prepare("update imovel set codigo=? descricao=? preco=? where codigo=?");
		$Comando->bindParam(1,$this->$codigo);
		$Comando->bindParam(2,$this->$descricao);
		$Comando->bindParam(3,$this->$preco);
		$Comando->bindParam(4,$this->$codigo);
		

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
	return $retorno;
	}

	public function consultar()
	{
		include "conexao.php";

		try{
	    $Comando=$conexao->prepare("select * from imovel where codigo=?");
		$Comando->bindParam(1,$codigo);

		$Comando->execute();
		$imovel = $Comando->fetchAll();

		$retorno = json_encode($imovel);
		return $retorno;
    }
	catch(PDOExecption $Erro)
	{
    	$retorno = "deu erro mano " . $Erro->getMessage();
	}

	}

}

?>
<?php

include "conexao.php";

$email = $_POST["email"];
$senha = $_POST["senha"];
$botao = $_POST["Entrar"];

if ($botao == "Entrar") {
	
	try {
		$comando=$conexao->prepare("select cpf from usuario where email=? and senha=?");
		$comando->bindParam(1,$email);
		$comando->bindParam(2,$senha);

		$comando->execute();

		if ($comando->rowCount()>0) {
			
			header("location: usuario.html");
		}
		else{

			echo "email ou senha invalidos";
		}
	} catch (PDOException $e) {
		
		 echo "deu erro mano" . $e->getMessage();
	}
}
   
?>
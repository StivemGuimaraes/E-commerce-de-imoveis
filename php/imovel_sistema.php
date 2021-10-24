<<?php

include "classe iml_sistema.php";

$imovel = new iml_sistema();

$botao = $_POST["botao"];
$arquivoTmp = $FILES['foto']['tmp_name'];
$Destino = 'imagens/'.$arquivoAtual;
$imovel->setFoto($_FILES['foto']['name']);
$imovel->setDescricao($_POST["descricao"]);
$imovel->setPreco($_POST["preco"]);
$imovel->setCodigo($_POST["codigo"]);

if ($botao == "incluir") {
	move_uploaded_file($arquivoTmp, $Destino);
	echo $imovel->incluir();
}
if ($botao == "deletar") {
	echo $imovel->exclusao();
	unlink("imagens/".$linha->foto."");
}

if ($botao == "consultar") {
	echo $imovel->colsulta();
}
if ($botao == "alterar") {
	echo $imovel->alterar();
}
if ($botao == "colocar casa no site") {
	echo $imovel->colsultar();
}
if ($botao == "colocar sitio no site") {
	echo $imovel->colsultar();
}
if ($botao == "colocar chácara no site") {
	echo $imovel->colsultar();
}
 ?>
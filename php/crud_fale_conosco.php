<?php

require_once('cms/php/geral.php');


	function Inserir($nome,$email,$titulo,$mensagem,$categoria){

		$conexao = connect();
		$sql = "insert into faleconosco (nome, email, titulo, mensagem, categoria) values ('".$nome."','".$email."','".$titulo."','".$mensagem."',".$categoria.");";
		$insert = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		// header("location:fale_conosco.php");

	}

?>

<?php

	require_once('../cms/php/geral.php');

	
	if(isset($_GET['prato_id'])){
		$prato_id = $_GET['prato_id'];

		$conexao = connect();
		$sql = "select * from prato where prato_id = ".$prato_id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);

		$qtd_views = $array['qtde_visualizacoes'];

		$qtd_views = $qtd_views + 1;

		$conexao = connect();
		$sql = "update prato set qtde_visualizacoes = ".$qtd_views ." where prato_id = ".$prato_id;
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
	}


	


?>
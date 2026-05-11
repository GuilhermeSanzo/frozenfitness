<?php
	
	require_once('../../cms/php/geral.php');
	// error_reporting(0);
	
	if(isset($_GET['pedido_id'])){

		$pedido_id = $_GET['pedido_id'];
		$lista = array();
		$conexao = connect();

		$sql = "update pedido set status_id = 7 where pedido_id = ".$pedido_id;
		
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		
		$lista = array();
		$lista[0] = array(
			"resultado" => "1",
			);
		echo json_encode($lista[0]);
	} 
?>


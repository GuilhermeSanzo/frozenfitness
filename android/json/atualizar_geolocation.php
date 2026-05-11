<?php
	
	require_once('../../cms/php/geral.php');
	// error_reporting(0);
	
	if(isset($_GET['usuario_id'])){

		$usuario_id = $_GET['usuario_id'];
		$latitude = $_GET['latitude'];
		$longitude = $_GET['longitude'];
		$lista = array();
		$conexao = connect();

		$sql = "update caminhao set latitude = ".$latitude.", longitude = ".$longitude." where motorista_id = ".$usuario_id;
		
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		
		$lista = array();
		$lista[0] = array(
			"resultado" => "1",
			);
		echo json_encode($lista[0]);
	} 
?>


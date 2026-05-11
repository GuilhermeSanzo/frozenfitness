<?php
	
	require_once('../../cms/php/geral.php');
	// error_reporting(0);
	
	if(isset($_GET['pedido_id'])){

		$pedido_id = $_GET['pedido_id'];
		$lista = array();
		 $conexao = connect();

		$sql = "select p.pedido_id ,c.latitude, c.longitude, c.placa
				from pedido as p
				inner join caminhao as c
				on c.caminhao_id = p.caminhao_id
				where p.pedido_id = ".$pedido_id.";";
		
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		$lista = array();
		$lista[0] = array(
		"latitude" => $array['latitude'],
		"longitude" => $array['longitude'],
		"placa" => $array['placa'],
		);
		echo json_encode($lista[0]);
	} 
?>


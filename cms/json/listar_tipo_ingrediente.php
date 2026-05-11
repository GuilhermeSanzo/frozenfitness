<?php

	require_once('../php/geral.php');

	$conexao = connect();

	$sql = "select * from tipo_ingrediente";
	$select = mysqli_query($conexao, $sql);
	mysqli_close($conexao);
	$i = 0;
	$lista = array();

	while($array = mysqli_fetch_array($select)){
		$lista[$i] = array('tipo_ingrediente_id' => $array['tipo_ingrediente_id'], 'tipo_ingrediente' => $array['nome']);
		$i++;
	}

	echo json_encode($lista);


 ?>

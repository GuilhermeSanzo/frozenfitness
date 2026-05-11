<?php

	require_once('../php/geral.php');

	$conexao = connect();

	$sql = "select * from tipo_dieta";
	$select = mysqli_query($conexao, $sql);
	mysqli_close($conexao);
	$i = 0;
	$lista = array();


	while($array = mysqli_fetch_array($select)){
		$lista[$i] = array('tipo_dieta_id' => $array['tipo_dieta_id'], 'categoria_prato' => $array['nome']);
		$i++;
	}

	echo json_encode($lista);


 ?>

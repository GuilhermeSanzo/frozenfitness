<?php

	require_once('../php/geral.php');

	$conexao = connect();

	$sql = "select * from horario_do_dia";
	$select = mysqli_query($conexao, $sql);
	mysqli_close($conexao);
	$i = 0;
	$lista = array();


	while($array = mysqli_fetch_array($select)){
		$lista[$i] = array('horario_do_dia_id' => utf8_encode($array['horario_do_dia_id']), 'horario_do_dia' => $array['nome']);
		$i++;
	}

	echo json_encode($lista);


 ?>

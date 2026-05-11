<?php

	require_once('../php/geral.php');

	if(isset($_POST['tipo_dieta_id'])){
		$conexao = connect();
		// $tipo_ingrediente_id = $_GET['tipo_ingrediente_id'];

		$tipo_dieta_id = $_POST['tipo_dieta_id'];

		$sql = "select * from prato where tipo_dieta_id = ".$tipo_dieta_id;
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);
		$i = 0;
		$lista = array();


		while($array = mysqli_fetch_array($select)){
			$lista[$i] = array('prato_id' => utf8_encode($array['prato_id']), 'prato' => $array['nome']);
			$i++;
		}

		echo json_encode($lista);
	}

	if(isset($_GET['prato_id'])){
		$conexao = connect();
		// $tipo_ingrediente_id = $_GET['tipo_ingrediente_id'];

		$prato_id = $_GET['prato_id'];

		$sql = "select * from prato where prato_id = ".$prato_id;
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);
		$i = 0;
		$lista = array();

		$array = mysqli_fetch_array($select);
		$lista[0] = array('caminho_imagem' => substr($array['caminho_imagem'], 3));

		echo json_encode($lista[0]);
	}



 ?>

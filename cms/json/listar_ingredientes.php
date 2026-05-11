<?php

	require_once('../php/geral.php');

	if(isset($_POST['tipo_ingrediente_id'])){
		$conexao = connect();
		// $tipo_ingrediente_id = $_GET['tipo_ingrediente_id'];

		$tipo_ingrediente_id = $_POST['tipo_ingrediente_id'];

		$sql = "select * from ingrediente where tipo_ingrediente_id = ".$tipo_ingrediente_id;
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);
		$i = 0;
		$lista = array();


		while($array = mysqli_fetch_array($select)){
			$lista[$i] = array('ingrediente_id' => utf8_encode($array['ingrediente_id']), 'ingrediente' => $array['nome']);
			$i++;
		}

		echo json_encode($lista);
	}

	if(isset($_GET['ingrediente_id'])){
		$conexao = connect();
		// $tipo_ingrediente_id = $_GET['tipo_ingrediente_id'];

		$ingrediente_id = $_GET['ingrediente_id'];

		$sql = "select * from ingrediente where ingrediente_id = ".$ingrediente_id;
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);
		$i = 0;
		$lista = array();

		$array = mysqli_fetch_array($select);
		$lista[0] = array('caminho_imagem' => utf8_encode($array['caminho_imagem']));

		echo json_encode($lista[0]);
	}



 ?>

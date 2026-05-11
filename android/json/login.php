<?php
	
	require_once('../../cms/php/geral.php');
	// error_reporting(0);

	$usuario = "";
	$senha = "";
	
	if(isset($_GET['email'])){

		$usuario = $_GET['email'];
		$senha = $_GET['senha'];
		$modo = $_GET['modo'];
		$lista = array();
		$conexao = connect();

		if ($modo == "1"){
			$sql = "select usuario_id,caminho_imagem, nome, sobre_nome, email, (select nome from sexo where sexo_id = sexo) as sexo, data_nascimento,'1' as resultado from usuario where email = '".$usuario."' && senha = '".$senha."';";
		
			$select = mysqli_query($conexao,$sql);
			mysqli_close($conexao);
			$array = mysqli_fetch_array($select);
			$lista = array();
			if($array['resultado'] == '1'){
				$lista[0] = array(
				"usuario_id" => $array['usuario_id'],
				"email" => $array['email'],
				"caminho_imagem" => "http://www.ypfrozen.com.br/".$array['caminho_imagem'],
				"nome" => $array['nome'],
				"sobre_nome" => $array['sobre_nome'],
				"sexo" => $array['sexo'],
				"data_nascimento" => $array['data_nascimento'],
				"resultado" => $array['resultado']
				);
			}else{
				$lista[0] = array(
				"usuario_id" => '',
				"email" => '',
				"nome" => '',
				"sobre_nome" => '',
				"caminho_imagem" => '',
				"sexo" => '',
				"data_nascimento" => '',
				"resultado" => '0'
				);
			}
		}else if($modo == "2"){
			$sql = "select motorista_id, nome, email, 
			data_nascimento,'1' as resultado from motorista where 
			email = '".$usuario."' && senha = '".$senha."';";
		
			$select = mysqli_query($conexao,$sql);
			mysqli_close($conexao);
			$array = mysqli_fetch_array($select);
			$lista = array();
			if($array['resultado'] == '1'){
				$lista[0] = array(
				"usuario_id" => $array['motorista_id'],
				"email" => $array['email'],
				"nome" => $array['nome'],
				"caminho_imagem" => 'http://www.ypfrozen.com.br/img/usuario/img_user.png',
				"data_nascimento" => $array['data_nascimento'],
				"resultado" => $array['resultado']
				);
			}else{
				$lista[0] = array(
				"usuario_id" => '',
				"email" => '',
				"nome" => '',
				"data_nascimento" => '',
				"caminho_imagem" => '',
				"resultado" => ''
				);
			}
		}else{
			$lista = array();
			$lista[0] = array(
			"usuario_id" => '',
			"email" => '',
			"nome" => '',
			"data_nascimento" => '',
			"caminho_imagem" => '',
			"resultado" => ''
			);
		}
		
		echo json_encode($lista[0]);
	} 
?>


<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome){
			$conexao = connect();
			$sql = "insert into tipo_usuario (nome) values ('".$nome."');";
			echo $sql;
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_tipo_usuario.php");
	}

	function Listar(){
		$conexao = connect();
		$sql = "select * from tipo_usuario";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td><a href='cadastro_tipo_usuario.php?modo=editar&id=".$array['tipo_usuario_id']."'>Editar</a> | <a href='cadastro_tipo_usuario.php?modo=excluir&id=".$array['tipo_usuario_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select * from tipo_usuario where tipo_usuario_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($tipo_usuario_id,$nome){
		$conexao = connect();
		$sql = "update tipo_usuario set nome = '".$nome."' where tipo_usuario_id = ".$tipo_usuario_id;
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_tipo_usuario.php");
	}

	function Excluir($id){
			
	$conexao = connect();
	$sql = "delete from tipo_usuario where tipo_usuario_id = ".$id;
	$delete = mysqli_query($conexao,$sql);
	mysqli_close($conexao);
	
	header("location:cadastro_tipo_usuario.php");
	}		


?>
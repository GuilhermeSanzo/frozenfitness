<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome,$abreviatura){
			$conexao = connect();
			$sql = "insert into unidade (nome,abreviatura) values ('".$nome."','".$abreviatura."');";
			echo $sql;
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_unidade.php");
	}

	function Listar(){
		$conexao = connect();
		$sql = "select * from unidade";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td>".$array['abreviatura']."</td>";
			echo "<td><a href='cadastro_unidade.php?modo=editar&id=".$array['unidade_id']."'>Editar</a> | <a href='cadastro_unidade.php?modo=excluir&id=".$array['unidade_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select * from unidade where unidade_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($unidade_id,$nome,$abreviatura){
		$conexao = connect();
		$sql = "update unidade set nome = '".$nome."',abreviatura = '".$abreviatura."' where unidade_id = ".$unidade_id;
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_unidade.php");
	}

	function Excluir($id){
			
	$conexao = connect();
	$sql = "delete from unidade where unidade_id = ".$id;
	$delete = mysqli_query($conexao,$sql);
	mysqli_close($conexao);
	
	header("location:cadastro_unidade.php");
	}		


?>
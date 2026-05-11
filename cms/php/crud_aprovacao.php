<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome,$abreviatura){
			$conexao = connect();
			$sql = "insert into aprovacao (nome) values ('".$nome."');";
			echo $sql;
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_aprovacao.php");
	}

	function Listar(){
		$conexao = connect();
		$sql = "select * from aprovacao";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td><a href='cadastro_aprovacao.php?modo=editar&id=".$array['aprovacao_id']."'>Editar</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select * from aprovacao where aprovacao_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($aprovacao_id,$nome,$abreviatura){
		$conexao = connect();
		$sql = "update aprovacao set nome = '".$nome."' where aprovacao_id = ".$aprovacao_id;
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_aprovacao.php");
	}

	function Excluir($id){
			
	$conexao = connect();
	$sql = "delete from aprovacao where aprovacao_id = ".$id;
	$delete = mysqli_query($conexao,$sql);
	mysqli_close($conexao);
	
	header("location:cadastro_aprovacao.php");
	}		


?>
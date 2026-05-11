<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome){
			$conexao = connect();
			$sql = "insert into operacao (nome) values ('".$nome."');";
			echo $sql;
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_operacao.php");
	}

	function Listar(){
		$conexao = connect();
		$sql = "select * from operacao";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td><a href='cadastro_operacao.php?modo=editar&id=".$array['operacao_id']."'>Editar</a> | <a href='cadastro_operacao.php?modo=excluir&id=".$array['operacao_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select * from operacao where operacao_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($operacao_id,$nome){
		$conexao = connect();
		$sql = "update operacao set nome = '".$nome."' where operacao_id = ".$operacao_id;
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_operacao.php");
	}

	function Excluir($id){
			
	$conexao = connect();
	$sql = "delete from operacao where operacao_id = ".$id;
	$delete = mysqli_query($conexao,$sql);
	mysqli_close($conexao);
	
	header("location:cadastro_operacao.php");
	}		


?>
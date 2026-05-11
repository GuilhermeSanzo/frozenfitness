<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome){
			$conexao = connect();
			$sql = "insert into categoria_fale_conosco (nome) values ('".$nome."');";
			echo $sql;
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_categoria_fale_conosco.php");
	}

	function Listar(){
		$conexao = connect();
		$sql = "select * from categoria_fale_conosco";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td><a href='cadastro_categoria_fale_conosco.php?modo=editar&id=".$array['categoria_id']."'>Editar</a> | <a href='cadastro_categoria_fale_conosco.php?modo=excluir&id=".$array['categoria_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select * from categoria_fale_conosco where categoria_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($categoria_id,$nome){
		$conexao = connect();
		$sql = "update categoria_fale_conosco set nome = '".$nome."' where categoria_id = ".$categoria_id;
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_categoria_fale_conosco.php");
	}

	function Excluir($id){
			
	$conexao = connect();
	$sql = "delete from categoria_fale_conosco where categoria_id = ".$id;
	$delete = mysqli_query($conexao,$sql);
	mysqli_close($conexao);
	
	header("location:cadastro_categoria_fale_conosco.php");
	}		


?>
<?php

	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome,$desconto){
			$conexao = connect();
			$sql = "insert into promocao (nome, porcentagem_desc) values ('".$nome."',".$desconto.");";
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);
			header("location:cadastro_promocao.php");
	}

	function Listar(){
		$conexao = connect();
		$sql = "select promocao_id, nome, porcentagem_desc as 'desconto' from promocao;";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td>".$array['desconto']."%</td>";
			echo "<td><a href='cadastro_promocao.php?modo=editar&id=".$array['promocao_id']."'>Editar</a> | <a href='cadastro_promocao.php?modo=excluir&id=".$array['promocao_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select promocao_id, nome, porcentagem_desc as 'desconto' from promocao where promocao_id =". $id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($promocao_id,$nome,$desconto){
		$conexao = connect();
		$sql = "update promocao set nome = '".$nome."', porcentagem_desc = ".$desconto." where promocao_id = ".$promocao_id;
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_promocao.php");
	}

	function Excluir($id){

			$conexao = connect();
			$sql = "delete from promocao where promocao_id = ".$id;
			$delete = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_promocao.php");
	}


?>

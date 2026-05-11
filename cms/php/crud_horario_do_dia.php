<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome){
			$conexao = connect();
			$sql = "insert into horario_do_dia (nome) values ('".$nome."');";
			echo $sql;
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_horario_do_dia.php");
	}

	function Listar(){
		$conexao = connect();
		$sql = "select * from horario_do_dia order by horario_do_dia_id desc";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td><a href='cadastro_horario_do_dia.php?modo=editar&id=".$array['horario_do_dia_id']."'>Editar</a> | <a href='cadastro_horario_do_dia.php?modo=excluir&id=".$array['horario_do_dia_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select * from horario_do_dia where horario_do_dia_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($horario_do_dia_id,$nome){
		$conexao = connect();
		$sql = "update horario_do_dia set nome = '".$nome."' where horario_do_dia_id = ".$horario_do_dia_id;
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_horario_do_dia.php");
	}

	function Excluir($id){
			
	$conexao = connect();
	$sql = "delete from horario_do_dia where horario_do_dia_id = ".$id;
	$delete = mysqli_query($conexao,$sql);
	mysqli_close($conexao);
	
	header("location:cadastro_horario_do_dia.php");
	}		


?>
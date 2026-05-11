<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome){
			$conexao = connect();
			$sql = "insert into endereco (logradouro, numero, cep, tipo_endereco_id, bairro,cidade_id) values ('".$logradouro."','".$numero."','".$cep."',1,'".$bairro."','".$cidade."');";
			echo $sql;
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			$conexao = connect();
			$sql = "insert into tipo_ingrediente (nome) values ('".$nome."');";
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_tipo_ingrediente.php");
	}

	function Listar(){
		$conexao = connect();
		$sql = "select * from tipo_ingrediente";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td><a href='cadastro_tipo_ingrediente.php?modo=editar&id=".$array['tipo_ingrediente_id']."'>Editar</a> | <a href='cadastro_tipo_ingrediente.php?modo=excluir&id=".$array['tipo_ingrediente_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select * from tipo_ingrediente where tipo_ingrediente_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($tipo_ingrediente_id, $nome){
		$conexao = connect();

		$sql = "update tipo_ingrediente set nome = '".$nome."' where tipo_ingrediente_id = ".$tipo_ingrediente_id;

		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);	
			
		header("location:cadastro_tipo_ingrediente.php");
	}

	function Excluir($id){
			$conexao = connect();
			$sql = "select * from tipo_ingrediente;";
			$select = mysqli_query($conexao,$sql);
			$array = mysqli_fetch_array($select);
			mysqli_close($conexao);

			$conexao = connect();
			$sql = "delete from tipo_ingrediente where tipo_ingrediente_id = ".$id;
			$delete = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_tipo_ingrediente.php");
	}


?>
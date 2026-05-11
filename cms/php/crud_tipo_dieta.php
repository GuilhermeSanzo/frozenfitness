<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome,$caminho_imagem,$imagem){
			$conexao = connect();
			$sql = "insert into tipo_dieta (nome,caminho_imagem) values ('".$nome."','".$caminho_imagem."');";
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_tipo_dieta.php");
	}

	function Listar(){
		$conexao = connect();
		$sql = "select * from tipo_dieta";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td><img src='".$array['caminho_imagem']."'></td>";
			echo "<td><a href='cadastro_tipo_dieta.php?modo=editar&id=".$array['tipo_dieta_id']."'>Editar</a> | <a href='cadastro_tipo_dieta.php?modo=excluir&id=".$array['tipo_dieta_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select * from tipo_dieta where tipo_dieta_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($tipo_dieta_id,$nome,$caminho_imagem,$imagem){
		$conexao = connect();

		if($caminho_imagem == 'img/'){
			$sql = "update tipo_dieta set nome = '".$nome."' where tipo_dieta_id = ".$tipo_dieta_id;
		}else{
			if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_imagem)){
				$sql = "update tipo_dieta set nome = '".$nome."', caminho_imagem = '".$caminho_imagem."' where tipo_dieta_id = ".$tipo_dieta_id;
			}
		}
		
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_tipo_dieta.php");
	}

	function Excluir($id){
			
	$conexao = connect();
	$sql = "delete from tipo_dieta where tipo_dieta_id = ".$id;
	$delete = mysqli_query($conexao,$sql);
	mysqli_close($conexao);
	
	header("location:cadastro_tipo_dieta.php");
	}		


?>
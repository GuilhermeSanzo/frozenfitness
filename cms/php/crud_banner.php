<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome,$caminho_imagem,$imagem){
		if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_imagem)){
			$conexao = connect();
			$sql = "insert into banner (nome, caminho_imagem) values ('".$nome."','".$caminho_imagem."');";
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_banner.php");
		}else{
			erro();
			header("location:cadastro_banner.php");
		}
	}

	function Listar(){
		$conexao = connect();
		$sql = "select * from banner;
		";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td><img src='../cms/".$array['caminho_imagem']."'></td>";
			echo "<td><a href='cadastro_banner.php?modo=editar&id=".$array['banner_id']."'>Editar</a> | <a href='cadastro_banner.php?modo=excluir&id=".$array['banner_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select * from banner where banner_id =". $id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($banner_id,$nome,$caminho_imagem,$imagem){
		$conexao = connect();

		if($caminho_imagem == 'img/'){
			$sql = "update banner set nome = '".$nome."' where banner_id = ".$banner_id;
		}else{
			if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_imagem)){
				$sql = "update banner set nome = '".$nome."', caminho_imagem = '".$caminho_imagem."' where banner_id = ".$banner_id;
			}
		}
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_banner.php");
	}

	function Excluir($id){
			
			$conexao = connect();
			$sql = "delete from banner where banner_id = ".$id;
			$delete = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_banner.php");
	}


?>
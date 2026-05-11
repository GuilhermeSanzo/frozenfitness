<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($titulo,$conteudo,$artigo_data,$autor,$value_categoria_artigo,$caminho_imagem,$imagem){
		if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_imagem)){
			$conexao = connect();
			$sql = "insert into artigo (titulo,conteudo,artigo_data,autor,categoria_artigo_id,caminho_imagem) values ('".$titulo."','".$conteudo."','".$artigo_data."','".$autor."','".$value_categoria_artigo."','".$caminho_imagem."');";
			
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_artigo.php");
		}else{
			erro();
			header("location:cadastro_artigo.php");
		}
	}

	function Listar(){
		$conexao = connect();
		$sql = "select a.*, ca.nome as categoria_artigo from artigo as a 
				inner join categoria_artigo as ca 
				on ca.categoria_artigo_id = a.categoria_artigo_id";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['titulo']."</td>";
			echo "<td>".substr($array['conteudo'], 0,27)."...</td>";
			echo "<td><img src='".$array['caminho_imagem']."'></td>";
			echo "<td>".$array['artigo_data']."</td>";
			echo "<td>".$array['autor']."</td>";
			echo "<td>".$array['categoria_artigo']."</td>";
			echo "<td><a href='cadastro_artigo.php?modo=editar&id=".$array['artigo_id']."'>Editar</a> | <a href='cadastro_artigo.php?modo=excluir&id=".$array['artigo_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select a.*, ca.nome as categoria_artigo from artigo as a 
				inner join categoria_artigo as ca 
				on ca.categoria_artigo_id = a.categoria_artigo_id
				where a.artigo_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($artigo_id,$titulo,$conteudo,$artigo_data,$autor,$value_categoria_artigo,$caminho_imagem,$imagem){
		$conexao = connect();

		if($caminho_imagem == 'img/'){
			$sql = "update artigo set titulo = '".$titulo."', conteudo = '".$conteudo."', artigo_data = '".$artigo_data."', autor = '".$autor."', categoria_artigo_id = '".$value_categoria_artigo."' where artigo_id = ".$artigo_id;
		}else{
			if(move_uploaded_file($imagem, $caminho_imagem)){
			$sql = "update artigo set titulo = '".$titulo."', conteudo = '".$conteudo."', artigo_data = '".$artigo_data."', autor = '".$autor."', categoria_artigo_id = '".$value_categoria_artigo."', caminho_imagem = '".$caminho_imagem."' where artigo_id = ".$artigo_id;
			}
		}
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_artigo.php");
	}

	function Excluir($id){
			
			$conexao = connect();
			$sql = "delete from artigo where artigo_id = ".$id;
			$delete = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_artigo.php");
	}


?>
<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome,$unidade,$tipo_ingrediente,$kcal_por_100g,$caminho_imagem,$imagem){
		if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_imagem)){
			$conexao = connect();
			$sql = "insert into ingrediente (nome, caminho_imagem, unidade_id, tipo_ingrediente_id, kcal_por_100g) values ('".$nome."','".$caminho_imagem."','".$unidade."','".$tipo_ingrediente."','".$kcal_por_100g."');";
			echo ($sql);
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_ingrediente.php");
		}else{
			erro();
			header("location:cadastro_ingrediente.php");
		}
	}

	function Listar(){
		$conexao = connect();
		$sql = "select i.ingrediente_id, i.nome, i.kcal_por_100g, i.caminho_imagem,ti.tipo_ingrediente_id,ti.nome as tipo_ingrediente,u.unidade_id,u.nome as unidade
				from ingrediente as i
				inner join tipo_ingrediente as ti
				on ti.tipo_ingrediente_id = i.tipo_ingrediente_id
				inner join unidade as u
				on u.unidade_id = i.unidade_id";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td>".$array['unidade']."</td>";
			echo "<td>".$array['tipo_ingrediente']."</td>";
			echo "<td>".$array['kcal_por_100g']."</td>";
			echo "<td><img src='".$array['caminho_imagem']."'></td>";
			echo "<td><a href='cadastro_ingrediente.php?modo=editar&id=".$array['ingrediente_id']."'>Editar</a> | <a href='cadastro_ingrediente.php?modo=excluir&id=".$array['ingrediente_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select i.ingrediente_id, i.nome, i.kcal_por_100g, i.caminho_imagem,ti.tipo_ingrediente_id,ti.nome as tipo_ingrediente,u.unidade_id,u.nome as unidade 
				from ingrediente as i
				inner join tipo_ingrediente as ti
				on ti.tipo_ingrediente_id = i.tipo_ingrediente_id
				inner join unidade as u
				on u.unidade_id = i.unidade_id 
				where ingrediente_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($ingrediente_id,$nome,$unidade,$tipo_ingrediente,$kcal_por_100g,$caminho_imagem,$imagem){
		$conexao = connect();

		if($caminho_imagem == 'img/'){
			$sql = "update ingrediente set nome = '".$nome."', unidade_id = '".$unidade."', tipo_ingrediente_id = '".$tipo_ingrediente."', kcal_por_100g = '".$kcal_por_100g."' where ingrediente_id = ".$ingrediente_id;
		}else{
			if(move_uploaded_file($imagem, $caminho_imagem)){
				$sql = "update ingrediente set nome = '".$nome."', caminho_imagem = '".$caminho_imagem."', unidade_id = '".$unidade."', tipo_ingrediente_id = '".$tipo_ingrediente."', kcal_por_100g = '".$kcal_por_100g."' where ingrediente_id = ".$ingrediente_id;

			}
		}

		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_ingrediente.php");
	}

	function Excluir($id){
			$conexao = connect();
			$sql = "select * from ingrediente;";
			$select = mysqli_query($conexao,$sql);
			$array = mysqli_fetch_array($select);
			mysqli_close($conexao);

			$conexao = connect();
			$sql = "delete from ingrediente where ingrediente_id = ".$id;
			$delete = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_ingrediente.php");
	}


?>
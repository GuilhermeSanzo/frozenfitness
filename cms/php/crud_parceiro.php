<?php

	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome,$caminho_imagem,$imagem,$telefone,$logradouro,$numero,$bairro,$cep,$cidade,$estado){
		if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_imagem)){
			$conexao = connect();
			$sql = "insert into endereco (nome, numero, cep, tipo_endereco_id, bairro, cidade, estado) values ('".$logradouro."','".$numero."','".$cep."',1,'".$bairro."','".$cidade."', '".$estado."');";
			echo $sql;
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			$conexao = connect();
			$sql = "select * from endereco order by endereco_id desc limit 1";
			$select = mysqli_query($conexao,$sql);
			$array = mysqli_fetch_array($select);
			mysqli_close($conexao);

			$conexao = connect();
			$sql = "insert into parceiro (nome, caminho_imagem, telefone, endereco_id) values ('".$nome."','".$caminho_imagem."','".$telefone."','".$array['endereco_id']."');";
			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_parceiros.php");
		}else{
			erro();
			header("location:cadastro_parceiros.php");
		}
	}

	function Listar(){
		$conexao = connect();
		$sql = "select p.parceiro_id,p.nome as parceiro,p.caminho_imagem,p.telefone,e.logradouro,e.numero,e.cep,e.bairro, e.cidade, e.estado, e.nome as 'nome_rua'
		from parceiro as p
		inner join endereco as e
		on p.endereco_id = e.endereco_id
		";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['parceiro']."</td>";
			echo "<td>".$array['telefone']."</td>";
			echo "<td><img src='".$array['caminho_imagem']."'></td>";
			echo "<td>".$array['nome_rua']."</td>";
			echo "<td>".$array['numero']."</td>";
			echo "<td>".$array['bairro']."</td>";
			echo "<td>".$array['cidade']."</td>";
			echo "<td>".$array['estado']."</td>";
			echo "<td>".$array['cep']."</td>";
			echo "<td><a href='cadastro_parceiros.php?modo=editar&id=".$array['parceiro_id']."'>Editar</a> | <a href='cadastro_parceiros.php?modo=excluir&id=".$array['parceiro_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select p.parceiro_id,p.nome as parceiro,p.caminho_imagem,p.telefone,e.nome as nome_rua,e.numero,e.cep,e.bairro, e.cidade, e.estado
		from parceiro as p
		inner join endereco as e
		on (p.endereco_id = e.endereco_id)
		where parceiro_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($parceiro_id,$nome,$caminho_imagem,$imagem,$telefone,$logradouro,$numero,$bairro,$cep,$cidade,$estado){
		$conexao = connect();

		if($caminho_imagem == 'img/'){
			$sql = "update parceiro set nome = '".$nome."', telefone = '".$telefone."' where parceiro_id = ".$parceiro_id;
		}else{
			if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_imagem)){
				$sql = "update parceiro set nome = '".$nome."', caminho_imagem = '".$caminho_imagem."', telefone = '".$telefone."' where parceiro_id = ".$parceiro_id;
				echo $caminho_imagem;
			}
		}
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		$conexao = connect();
		$sql = "select endereco_id from parceiro where parceiro_id=".$parceiro_id;
		$select = mysqli_query($conexao,$sql);
		$array = mysqli_fetch_array($select);
		mysqli_close($conexao);

		$conexao = connect();
		$sql = "update endereco set nome = '".$logradouro."', numero = ".$numero.", bairro = '".$bairro."', cep = '".$cep."', cidade = '".$cidade."', estado = '".$estado."' where endereco_id = ".$array['endereco_id'];
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_parceiros.php");
	}

	function Excluir($id){
			$conexao = connect();
			$sql = "select * from parceiro;";
			$select = mysqli_query($conexao,$sql);
			$array = mysqli_fetch_array($select);
			mysqli_close($conexao);

			$conexao = connect();
			$sql = "delete from parceiro where parceiro_id = ".$id;
			$delete = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			$conexao = connect();
			$sql = "delete from endereco where endereco_id = ".$array['endereco_id'];
			$delete = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_parceiros.php");
	}


?>

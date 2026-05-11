<?php

	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($razao_social,$nome_fantasia,$cnpj,$logradouro,$numero,$bairro,$cep,$cidade,$estado){

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
		$sql = "insert into fornecedor (razao_social, nome_fantasia, cnpj, endereco_id) values ('".$razao_social."','".$nome_fantasia."','".$cnpj."','".$array['endereco_id']."');";
		$insert = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_fornecedor.php");

	}

	function Listar(){

		$conexao = connect();
		$sql = "select f.fornecedor_id,f.razao_social,f.nome_fantasia,f.cnpj, e.logradouro, e.numero, e.bairro, e.cidade, e.estado, e.cep, e.nome as 'nome_rua'
		from fornecedor as f
		inner join endereco as e
		on f.endereco_id = e.endereco_id
		";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['fornecedor_id']."</td>";
			echo "<td>".$array['razao_social']."</td>";
			echo "<td>".$array['nome_fantasia']."</td>";
			echo "<td>".$array['cnpj']."</td>";
			echo "<td>".$array['nome_rua']."</td>";
			echo "<td>".$array['numero']."</td>";
			echo "<td>".$array['bairro']."</td>";
			echo "<td>".$array['cidade']."</td>";
			echo "<td>".$array['estado']."</td>";
			echo "<td>".$array['cep']."</td>";
			echo "<td><a href='cadastro_fornecedor.php?modo=editar&id=".$array['fornecedor_id']."'>Editar</a> | <a href='cadastro_fornecedor.php?modo=excluir&id=".$array['fornecedor_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select f.fornecedor_id,f.razao_social,f.nome_fantasia,f.cnpj, e.nome as 'nome_rua',e.numero,e.bairro,e.cidade ,e.estado, e.cep
		from fornecedor as f
		inner join endereco as e
		on f.endereco_id = e.endereco_id
		where fornecedor_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($fornecedor_id,$razao_social,$nome_fantasia,$cnpj,$logradouro,$numero,$cep,$bairro,$cidade,$estado){
		$conexao = connect();

		$sql = "update fornecedor set razao_social = '".$razao_social."', nome_fantasia = '".$nome_fantasia."', cnpj = '".$cnpj."' where fornecedor_id = ".$fornecedor_id;

		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		$conexao = connect();
		$sql = "select endereco_id from fornecedor where fornecedor_id=".$fornecedor_id;
		$select = mysqli_query($conexao,$sql);
		$array = mysqli_fetch_array($select);
		mysqli_close($conexao);

		$conexao = connect();
		$sql = "update endereco set nome = '".$logradouro."', numero = '".$numero."', cep = '".$cep."', bairro = '".$bairro."',cidade = '".$cidade."', estado = '".$estado."' where endereco_id = ".$array['endereco_id'];
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_fornecedor.php");
	}

	function Excluir($id){
			$conexao = connect();
			$sql = "select * from fornecedor;";
			$select = mysqli_query($conexao,$sql);
			$array = mysqli_fetch_array($select);
			mysqli_close($conexao);

			$conexao = connect();
			$sql = "delete from fornecedor where fornecedor_id = ".$id;
			$delete = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			$conexao = connect();
			$sql = "delete from endereco where endereco_id = ".$array['endereco_id'];
			$delete = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_fornecedor.php");
	}


?>

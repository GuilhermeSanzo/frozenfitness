<?php 

	require_once('php/geral.php');

	// Pronto
	function Inserir($ingrediente, $fornecedor){

		$conexao = connect();
		$sql = "insert into rel_ingrediente_fornecedor(ingrediente_id, fornecedor_id) values (".$ingrediente.",".$fornecedor.");";
		$insert = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_rel_ingrediente_fornecedor.php");

	}

	// Pronto
	function Listar(){

		$conexao = connect();
		$sql = "select rel.rel_ingrediente_fornecedor_id, i.nome as 'ingrediente', i.ingrediente_id as 'ingrediente_id', f.nome_fantasia as 'fornecedor', f.fornecedor_id as 'fornecedor_id'
				from rel_ingrediente_fornecedor as rel
				inner join ingrediente as i on (rel.ingrediente_id = i.ingrediente_id)
				inner join fornecedor as f on (rel.fornecedor_id = f.fornecedor_id);";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['ingrediente']."</td>";
			echo "<td>".$array['fornecedor']."</td>";
			echo "<td><a href='cadastro_rel_ingrediente_fornecedor.php?modo=editar&id=".$array['rel_ingrediente_fornecedor_id']."'>Editar</a> | <a href='cadastro_rel_ingrediente_fornecedor.php?modo=excluir&id=".$array['rel_ingrediente_fornecedor_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select rel.rel_ingrediente_fornecedor_id, i.nome as 'ingrediente', i.ingrediente_id as 'ingrediente_id', f.nome_fantasia as 'fornecedor', f.fornecedor_id as 'fornecedor_id'
				from rel_ingrediente_fornecedor as rel
				inner join ingrediente as i on (rel.ingrediente_id = i.ingrediente_id)
				inner join fornecedor as f on (rel.fornecedor_id = f.fornecedor_id)
				where rel_ingrediente_fornecedor_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($id, $ingrediente,$fornecedor){
		
		$conexao = connect();
		$sql = "update rel_ingrediente_fornecedor set ingrediente_id = ".$ingrediente.", fornecedor_id = ".$fornecedor." where rel_ingrediente_fornecedor_id = ".$id;
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_rel_ingrediente_fornecedor.php");
	}

	// Pronto
	function Excluir($id){

			$conexao = connect();
			$sql = "delete from rel_ingrediente_fornecedor where rel_ingrediente_fornecedor_id = ".$id;
			$delete = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_rel_ingrediente_fornecedor.php");
	}


?>
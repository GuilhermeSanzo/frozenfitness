<?php

	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('php/geral.php');


	function Inserir($nome, $sobrenome, $email, $senha, $sexo, $data_nascimento, $tipo_usuario, $caminho_imagem){

			$conexao = connect();

			if($caminho_imagem != 'img/') {
				$sql = "insert into usuario (nome, sobre_nome, email, senha, sexo, data_nascimento, tipo_usuario_id, caminho_imagem) values
				('".$nome."','".$sobrenome."','".$email."','".$senha."',".$sexo.",'".$data_nascimento."', ".$tipo_usuario.", '".$caminho_imagem."');";
			} else {
				$sql = "insert into usuario (nome, sobre_nome, email, senha, sexo, data_nascimento, tipo_usuario_id) values
				('".$nome."','".$sobrenome."','".$email."','".$senha."',".$sexo.",'".$data_nascimento."', ".$tipo_usuario.");";
			}

			$insert = mysqli_query($conexao,$sql);
			mysqli_close($conexao);

			header("location:cadastro_usuario.php");

	}

	function Listar(){
		$conexao = connect();
		$sql = "select u.usuario_id, u.nome as 'usuario', u.sobre_nome as 'sobrenome', u.email, u.senha, u.sexo, u.data_nascimento, u.tipo_usuario_id, tu.nome as 'tipo_usuario' from usuario as u
				inner join tipo_usuario as tu on(u.tipo_usuario_id = tu.tipo_usuario_id) where tu.tipo_usuario_id <> 1 order by u.tipo_usuario_id asc;";
		$select = mysqli_query($conexao,$sql);

		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){


			echo "<tr>";
			echo "<td>".$array['usuario_id']."</td>";
			echo "<td>".$array['usuario']."</td>";
			echo "<td>".$array['email']."</td>";
			echo "<td>".$array['tipo_usuario']."</td>";
			echo"
			<td>
				<a href='cadastro_usuario.php?modo=detalhe&id=".$array['usuario_id']."#second_point'><span class='detail'></span></a>
				<a href='cadastro_usuario.php?modo=editar&id=".$array['usuario_id']."#first_point'><span class='edit'></span></a>
				<a href='cadastro_usuario.php?modo=excluir&id=".$array['usuario_id']."'><span class='remove'></span></a>
			</td>";
			//echo "<td><img src='".$array['caminho_imagem']."'></td>";
			//echo "<td><a href='cadastro_usuario.php?modo=editar&id=".$array['usuario_id']."'>Editar</a> | <a href='cadastro_usuario.php?modo=excluir&id=".$array['usuario_id']."'>Excluir</a></td>";
			echo "</tr>";
		}
	}

	function Buscar($id){
		$conexao = connect();
		$sql = "select u.usuario_id, u.nome as 'usuario', u.sobre_nome as 'sobrenome', u.email, u.senha, u.sexo, u.data_nascimento, u.tipo_usuario_id, tu.nome as 'tipo_usuario' from usuario as u
				inner join tipo_usuario as tu on(u.tipo_usuario_id = tu.tipo_usuario_id)
				where usuario_id = ".$id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
	}

	function Editar($usuario_id, $nome, $sobrenome, $email, $senha, $sexo, $data_nascimento, $tipo_usuario, $caminho_imagem){

		$conexao = connect();

		if($caminho_imagem != 'img/') {
			$sql = "update usuario set nome = '".$nome."', sobre_nome = '".$sobrenome."', email = '".$email."', senha = '".$senha."', sexo = ".$sexo.", data_nascimento = '".$data_nascimento."', tipo_usuario_id = ".$tipo_usuario.", caminho_imagem = '".$caminho_imagem."' where usuario_id = ".$usuario_id.";";
		} else {
			$sql = "update usuario set nome = '".$nome."', sobre_nome = '".$sobrenome."', email = '".$email."', senha = '".$senha."', sexo = ".$sexo.", data_nascimento = '".$data_nascimento."', tipo_usuario_id = ".$tipo_usuario." where usuario_id = ".$usuario_id.";";
		}

		echo($sql);
		$update = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_usuario.php");
	}

	function Excluir($id){
		$conexao = connect();
		$sql = "delete from usuario where usuario_id = ".$id;
		$delete = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		header("location:cadastro_usuario.php");
	}


?>

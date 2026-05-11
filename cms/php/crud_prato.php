<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('geral.php');

	//Inserindo o prato...
	if(isset($_GET['inserir'])){

		$conexao = connect();

		//variáveis para o prato
		$nome = $_POST['nome'];
		$validade = $_POST['validade'];
		$valor_unitario = $_POST['valor_unitario'];
		$tempo_preparo = $_POST['tempo_preparo'];
		$descricao = $_POST['descricao'];
		$tipo_usuario_id = "2";
		$tipo_dieta_id = $_POST['tipo_dieta_id'];

		//upload do arquivo
		$pastaDestino = 'img/';//diretório
		$nome_foto = basename($_FILES['arquivo']['name']);//nome da imagem
		$caminho_imagem = "../".$pastaDestino.$nome_foto;//caminho que será salvo no banco de dados
		$imagem = $_FILES['arquivo']['tmp_name'];// A imagem propriamente dita (Bitmap)

		//retorno do json
		$lista = array();

		if(move_uploaded_file($imagem, $caminho_imagem)){
			$sql = "insert into prato (nome, validade, valor_unitario, caminho_imagem, tipo_usuario_id, tempo_preparo, descricao, tipo_dieta_id) 
			values ('".$nome."', '".$validade."', '".$valor_unitario."', '".$caminho_imagem."', '".$tipo_usuario_id."', '".$tempo_preparo."', '".$descricao."', '".$tipo_dieta_id."')";

			if(mysqli_query($conexao,$sql)){

				$conexao2 = connect();
				$sql = "select * from prato order by prato_id desc limit 1";
				$select = mysqli_query($conexao2, $sql);
				$array = mysqli_fetch_array($select);

				$lista[0] = array("resultado" => "1","prato_id" => $array['prato_id']);
			}else{
				$lista[0] = array("resultado" => "0");
			}

			mysqli_close($conexao);
			echo json_encode($lista[0]);
		}
	}

	//Inserindo os ingredientes...
	if(isset($_GET['inserir_ingrediente'])){

		$prato_id = $_GET['prato_id'];
		$ingrediente_id = $_GET['ingrediente_id'];
		$quantidade = $_GET['quantidade'];

		$conexao = connect();
		$sql = "insert into rel_prato_ingrediente (qtd, ingrediente_id, prato_id) values ('".$quantidade."','".$ingrediente_id."','".$prato_id."')";
		$insert = mysqli_query($conexao, $sql);
		mysqli_close($conexao);

	}

	//Excluindo o prato...
	if(isset($_GET['excluir_prato'])){

		$prato_id = $_GET['prato_id'];

		$retorno = array();

		$conexao = connect();
		$sql = "delete from rel_prato_ingrediente where prato_id = ".$prato_id;
		if(mysqli_query($conexao, $sql)){
			$conexao2 = connect();
			$sql = "delete from prato where prato_id = ".$prato_id;
			if(mysqli_query($conexao2, $sql)){
				$retorno[0] = array("resultado" => "1");
			}else{
				$retorno[0] = array("resultado" => "0");
			}
		}else{
			$retorno[0] = array("resultado" => "0");
		}

		mysqli_close($conexao);
		mysqli_close($conexao2);

		echo json_encode($retorno[0]);
	}

	//Preenchendo as caixas para editar o prato...
	if(isset($_GET['editar_prato'])){

		$prato_id = $_GET['prato_id'];

		$prato = array();
		$ingredientes_do_prato = array();

		$ingredientes = array();
		$tipos_ingredientes = array();

		$conexao = connect();
		$sql = "select count(p.prato_id) as resultado, p.* , td.nome as categoria_prato
		from prato as p 
		inner join tipo_dieta as td 
		on td.tipo_dieta_id = p.tipo_dieta_id 
		where prato_id = ".$prato_id;
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);

		$conexao = connect();
		$sql = "select pi.ingrediente_id, i.nome as ingrediente,i.caminho_imagem, i.tipo_ingrediente_id, ti.nome as tipo_ingrediente, pi.qtd, pi.rel_prato_ingrediente_id
		from rel_prato_ingrediente as pi 
		inner join ingrediente as i
		on pi.ingrediente_id = i.ingrediente_id 
		inner join tipo_ingrediente as ti 
		on i.tipo_ingrediente_id = ti.tipo_ingrediente_id 
		where prato_id = ".$prato_id;
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);


		

		$i = 0;
		while ($array2 = mysqli_fetch_array($select)) {
			$ingredientes_do_prato[$i] = array(
				"rel_prato_ingrediente_id" => $array2['rel_prato_ingrediente_id'],
				"tipo_ingrediente_id" => $array2['tipo_ingrediente_id'],
				"caminho_imagem" => $array2['caminho_imagem'],
				"tipo_ingrediente" => $array2['tipo_ingrediente'],
				"ingrediente_id" => $array2['ingrediente_id'],
				"ingrediente" => $array2['ingrediente'],
				"qtd" => $array2['qtd']
				);
			$i++;
		}

		$conexao = connect();
		$sql = "select * from ingrediente";
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);

		$i = 0;
		while ($array3 = mysqli_fetch_array($select)) {
			$ingredientes[$i] = array(
				"ingrediente_id" => $array3['ingrediente_id'],
				"ingrediente" => $array3['nome']
				);
			$i++;
		}

		$conexao = connect();
		$sql = "select * from tipo_ingrediente";
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);

		$i = 0;
		while ($array3 = mysqli_fetch_array($select)) {
			$tipos_ingredientes[$i] = array(
				"tipo_ingrediente_id" => $array3['tipo_ingrediente_id'],
				"tipo_ingrediente" => $array3['nome']
				);
			$i++;
		}

		$conexao = connect();
		$sql = "select * from tipo_dieta";
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);

		$i = 0;
		while ($array3 = mysqli_fetch_array($select)) {
			$tipos_dieta[$i] = array(
				"tipo_dieta_id" => $array3['tipo_dieta_id'],
				"categoria_prato" => $array3['nome']
				);
			$i++;
		}

		
		$prato[0] = array(
			"resultado" => $array['resultado'],
			"nome" => $array['nome'],
			"validade" => $array['validade'],
			"valor_unitario" => $array['valor_unitario'],
			"tempo_preparo" => $array['tempo_preparo'],
			"ingredientes_do_prato" => $ingredientes_do_prato,
			"ingredientes" => $ingredientes,
			"tipos_ingredientes" => $tipos_ingredientes,
			"tipos_dieta" => $tipos_dieta,
			"descricao" => $array['descricao'],
			"tipo_dieta_id" => $array['tipo_dieta_id'],
			"categoria_prato" => $array['categoria_prato']
			);

		echo json_encode($prato[0]);
	}

	if(isset($_GET['atualizar_prato'])){

		//variáveis para o prato
		$prato_id = $_GET['prato_id'];
		$nome = $_POST['nome'];
		$validade = $_POST['validade'];
		$valor_unitario = $_POST['valor_unitario'];
		$tempo_preparo = $_POST['tempo_preparo'];
		$descricao = $_POST['descricao'];
		$tipo_dieta_id = $_POST['tipo_dieta_id'];

		//upload do arquivo
		$pastaDestino = 'img/';//diretório
		$nome_foto = basename($_FILES['arquivo']['name']);//nome da imagem
		$caminho_imagem = "../".$pastaDestino.$nome_foto;//caminho que será salvo no banco de dados
		$imagem = $_FILES['arquivo']['tmp_name'];// A imagem propriamente dita (Bitmap);

		if($caminho_imagem != "../img/"){
			//Com imagem
			if(move_uploaded_file($imagem, $caminho_imagem)){
				$conexao2 = connect();
				$sql = "update prato set nome = '".$nome."', validade = '".$validade."', caminho_imagem = '".$caminho_imagem."', valor_unitario = '".$valor_unitario."', tempo_preparo = '".$tempo_preparo."', descricao = '".$descricao."', tipo_dieta_id = '".$tipo_dieta_id."' where prato_id = ".$prato_id;
				$select = mysqli_query($conexao2, $sql);

				$lista[0] = array("resultado" => "1");
			}else{
				$lista[0] = array("resultado" => "0");
			}
		}else{
			//Imagem vazia...
			$conexao2 = connect();
			$sql = "update prato set nome = '".$nome."', validade = '".$validade."', valor_unitario = '".$valor_unitario."', tempo_preparo = '".$tempo_preparo."', descricao = '".$descricao."', tipo_dieta_id = '".$tipo_dieta_id."' where prato_id = ".$prato_id;

			$select = mysqli_query($conexao2, $sql);
			
			$lista[0] = array("resultado" => "1");
		}
		echo json_encode($lista[0]);
	}

	if(isset($_GET['lista_ingredientes_removidos'])){

		$conexao = connect();
		$lista_ingredientes_removidos = $_GET['lista_ingredientes_removidos'];
		$query = "delete from rel_prato_ingrediente where rel_prato_ingrediente_id in (0".$lista_ingredientes_removidos.");";
		mysqli_query($conexao,$query);

		$lista = array();
		$lista[0] = array("resultado" => "1");

		echo json_encode($lista[0]);

	}

	if(isset($_GET['atualizar_ingrediente'])){

		$conexao = connect();
		$rel_prato_ingrediente_id = $_GET['rel_prato_ingrediente_id'];
		$prato_id = $_GET['prato_id'];
		$ingrediente_id = $_GET['ingrediente_id'];
		$quantidade = $_GET['quantidade'];

		if(is_numeric($rel_prato_ingrediente_id)){
			$sql = "update rel_prato_ingrediente set qtd = ".$quantidade.",ingrediente_id = ".$ingrediente_id.", prato_id = ".$prato_id." where rel_prato_ingrediente_id = ".$rel_prato_ingrediente_id;
			$update = mysqli_query($conexao, $sql);
			mysqli_close($conexao);
		}else{
			$sql = "insert into rel_prato_ingrediente (qtd, ingrediente_id, prato_id) values ('".$quantidade."','".$ingrediente_id."','".$prato_id."')";
			$insert = mysqli_query($conexao, $sql);
			mysqli_close($conexao);
		}

	}

	function Listar(){
		$conexao = connect();
		$sql = "select * from prato";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td>".$array['validade']."</td>";
			echo "<td><img style='width:300px;heigth:120px' src='".substr($array['caminho_imagem'], 3)."'></td>";
			echo "<td>".$array['valor_unitario']."</td>";
			echo "<td>".$array['tempo_preparo']."</td>";
			echo "<td><a class='editar_prato' id='editar_prato".$array['prato_id']."' href='#'>Editar</a> | <a class='excluir_prato' id='excluir_prato".$array['prato_id']."' href='#'>Excluir</a></td>";
			echo "</tr>";
		}
	}


?>
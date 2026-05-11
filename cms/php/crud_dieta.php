<?php

	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('geral.php');

	//Inserindo o prato...
	if(isset($_GET['inserir'])){

		$conexao = connect();

		//variáveis para o prato
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$tipo_dieta_id = $_POST['tipo_dieta_id'];

		//retorno do json
		$lista = array();

		$sql = "insert into dieta (nome, descricao, tipo_dieta_id)
		values ('".$nome."', '".$descricao."', '".$tipo_dieta_id."')";

		if(mysqli_query($conexao,$sql)){

			$conexao2 = connect();
			$sql = "select * from dieta order by dieta_id desc limit 1";
			$select = mysqli_query($conexao2, $sql);
			$array = mysqli_fetch_array($select);

			$lista[0] = array("resultado" => "1","dieta_id" => $array['dieta_id']);
		}else{
			$lista[0] = array("resultado" => "0");
		}

		mysqli_close($conexao);
		echo json_encode($lista[0]);

	}

	//Inserindo os ingredientes...
	if(isset($_GET['inserir_prato'])){

		$dieta_id = $_GET['dieta_id'];
		$prato_id = $_GET['prato_id'];
		$dia_da_dieta = $_GET['dia_da_dieta'];
		$horario_do_dia = $_GET['horario_do_dia'];

		$conexao = connect();
		$sql = "insert into rel_dieta_prato (dia, horario_do_dia_id, prato_id, dieta_id) values ('".$dia_da_dieta."','".$horario_do_dia."','".$prato_id."','".$dieta_id."')";
		$insert = mysqli_query($conexao, $sql);
		mysqli_close($conexao);
	}

	//Excluindo o prato...
	if(isset($_GET['excluir_dieta'])){

		$dieta_id = $_GET['dieta_id'];

		$retorno = array();

		$conexao = connect();
		$sql = "delete from rel_dieta_prato where dieta_id = ".$dieta_id;

		if(mysqli_query($conexao, $sql)){
			mysqli_close($conexao);
			$conexao2 = connect();
			$sql = "delete from dieta where dieta_id = ".$dieta_id;
			if(mysqli_query($conexao2, $sql)){
				$retorno[0] = array("resultado" => "1");
				mysqli_close($conexao2);
			}else{
				$retorno[0] = array("resultado" => "0");
				mysqli_close($conexao2);
			}
		}else{
			$retorno[0] = array("resultado" => "0");
			mysqli_close($conexao);
		}

		echo json_encode($retorno[0]);
	}

	//Preenchendo as caixas para editar o prato...
	if(isset($_GET['editar_dieta'])){

		$dieta_id = $_GET['dieta_id'];

		$dieta = array();
		$pratos_da_dieta = array();

		$pratos = array();
		$tipos_dieta = array();

		$conexao = connect();
		$sql = "select count(*) as resultado,d.*, td.nome as tipo_dieta from dieta as d
		inner join tipo_dieta as td
		on td.tipo_dieta_id = d.tipo_dieta_id
		where dieta_id =".$dieta_id;
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);

		$conexao = connect();
		$sql = "select dp.*,
				h.nome as horario_do_dia,
				p.nome as prato,
				td.nome as tipo_dieta,
				td.tipo_dieta_id as tipo_dieta_id,
				p.caminho_imagem
				from rel_dieta_prato as dp
				inner join horario_do_dia h
				on h.horario_do_dia_id = dp.horario_do_dia_id
				inner join prato p
				on p.prato_id = dp.prato_id
				inner join dieta as d
				on d.dieta_id = dp.dieta_id
				inner join tipo_dieta as td
				on td.tipo_dieta_id = d.tipo_dieta_id
				where d.dieta_id = ".$dieta_id;

		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);

		$i = 0;
		while ($array2 = mysqli_fetch_array($select)) {

			$pratos_da_dieta[$i] = array(
				"rel_dieta_prato_id" => $array2['rel_dieta_prato_id'],
				"dia" => $array2['dia'],
				"horario_do_dia_id" => $array2['horario_do_dia_id'],
				"prato_id" => $array2['prato_id'],
				"dieta_id" => $array2['dieta_id'],
				"horario_do_dia" => $array2['horario_do_dia'],
				"prato" => $array2['prato'],
				"tipo_dieta" => $array2['tipo_dieta'],
				"tipo_dieta_id" => $array2['tipo_dieta_id'],
				"caminho_imagem"=> substr($array2['caminho_imagem'], 3)
				);
			$i++;
		}

		$conexao = connect();
		$sql = "select * from prato";
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);

		$i = 0;
		while ($array3 = mysqli_fetch_array($select)) {
			$pratos[$i] = array(
				"prato_id" => $array3['prato_id'],
				"prato" => $array3['nome']
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
				"tipo_dieta" => $array3['nome']
				);
			$i++;
		}

		$conexao = connect();
		$sql = "select * from horario_do_dia";
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);

		$i = 0;
		while ($array3 = mysqli_fetch_array($select)) {
			$horarios_do_dia[$i] = array(
				"horario_do_dia_id" => $array3['horario_do_dia_id'],
				"horario_do_dia" => $array3['nome']
				);
			$i++;
		}

		$dieta[0] = array(
			"resultado" => $array['resultado'],
			"dieta_id" => $array['dieta_id'],
			"nome" => $array['nome'],
			"descricao" => $array['descricao'],
			"tipo_dieta_id" => $array['tipo_dieta_id'],
			"tipo_dieta" => $array['tipo_dieta'],
			"pratos_da_dieta" => $pratos_da_dieta,
			"pratos" => $pratos,
			"tipos_dieta" => $tipos_dieta,
			"horarios_do_dia" => $horarios_do_dia
			);

		echo json_encode($dieta[0]);
	}

	if(isset($_GET['atualizar_dieta'])){

		//variáveis para o prato
		$dieta_id = $_GET['dieta_id'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$tipo_dieta_id = $_POST['tipo_dieta_id'];

		$conexao = connect();
		$sql = "update dieta set nome = '".$nome."', descricao = '".$descricao."', tipo_dieta_id = '".$tipo_dieta_id."' where dieta_id = ".$dieta_id;
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);

		$lista[0] = array("resultado" => "1");

		echo json_encode($lista[0]);
	}

	if(isset($_GET['lista_pratos_removidos'])){

		$conexao = connect();
		$lista_pratos_removidos = $_GET['lista_pratos_removidos'];
		$query = "delete from rel_dieta_prato where rel_dieta_prato_id in (0".$lista_pratos_removidos.");";
		mysqli_query($conexao,$query);

		$lista = array();
		$lista[0] = array("resultado" => "1");

		echo json_encode($lista[0]);

	}

	if(isset($_GET['atualizar_pratos'])){

		$conexao = connect();
		$dieta_id = $_GET['dieta_id'];
		$rel_dieta_prato_id = $_GET['rel_dieta_prato_id'];
		$prato_id = $_GET['prato_id'];
		$dia_da_dieta = $_GET['dia_da_dieta'];
		$horario_do_dia = $_GET['horario_do_dia'];

		if(is_numeric($rel_dieta_prato_id)){
			$sql = "update rel_dieta_prato set dia = ".$dia_da_dieta.",horario_do_dia_id = ".$horario_do_dia.", prato_id = ".$prato_id." where rel_dieta_prato_id = ".$rel_dieta_prato_id;
			$update = mysqli_query($conexao, $sql);
			mysqli_close($conexao);
		}else{
			$sql = "insert into rel_dieta_prato (dia, horario_do_dia_id, prato_id, dieta_id) values ('".$dia_da_dieta."','".$horario_do_dia."','".$prato_id."','".$dieta_id."')";
			$insert = mysqli_query($conexao, $sql);
			mysqli_close($conexao);
		}
	}

	function Listar(){
		$conexao = connect();
		$sql = "select d.*,
				td.nome as tipo_dieta,
				(select count(distinct dia) from rel_dieta_prato where dieta_id = d.dieta_id) as qtd_dias,
				td.cor
				from dieta as d
				inner join tipo_dieta as td
				on d.tipo_dieta_id = td.tipo_dieta_id
				inner join rel_dieta_prato as dp
				on dp.dieta_id = d.dieta_id
				group by dieta_id;";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td> <div class='box_dieta' style='background-color:".$array['cor']."'>
			  		<div class='box_dias_dieta'>
			  			Quantidade de dias:<br>
			   	 		<span class='dias_dieta'>".$array['qtd_dias']." Dia(s)</span>
			  			</div>
			      	<div class='box_tipo_dieta'>
			          ".$array['tipo_dieta']."
			      </div>
				</div> </td>";
			echo "<td>".$array['descricao']."</td>";
			echo "<td>".$array['tipo_dieta']."</td>";
			echo "<td><a class='editar_dieta' id='editar_dieta".$array['dieta_id']."' href='#'>Editar</a> | <a class='excluir_dieta' id='excluir_dieta".$array['dieta_id']."' href='#'>Excluir</a></td>";
			echo "</tr>";
		}
	}


?>

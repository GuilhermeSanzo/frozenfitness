<?php
	
	require_once('../php/geral.php');

	if(isset($_GET['listar_pratos_p_aprovar'])){

		$conexao = connect();

		$sql = "(select 
				p.prato_id as id,
				p.nome, 
				replace(concat('R$ ',round(p.valor_unitario,2)),'.',',') as valor_unitario, 
				substr(p.caminho_imagem,4) as caminho_imagem,
				'' as qtd_dias,
				'' as cor,
                '' as tipo_dieta,
				'prato' as tipo
				from prato as p
				inner join aprovacao as a 
				on a.aprovacao_id = p.aprovacao_id 
				where a.aprovacao_id = 1
				)
				union
				(select 
				d.dieta_id, 
				d.nome, 
				replace(concat('R$ ',round(sum(p.valor_unitario),2)),'.',',') as valor_unitario,
				'' as caminho_imagem,
				(select count(distinct dia) from rel_dieta_prato where dieta_id = d.dieta_id) as qtd_dias,
				td.cor,
                td.nome as tipo_dieta,
				'dieta' as tipo
				from dieta as d 
				inner join rel_dieta_prato as dp
				on dp.dieta_id = d.dieta_id 
				inner join prato as p
				on p.prato_id = dp.prato_id
				inner join tipo_dieta as td
				on d.tipo_dieta_id = td.tipo_dieta_id
				inner join aprovacao as a 
				on a.aprovacao_id = d.aprovacao_id 
				where a.aprovacao_id = 1
				group by dieta_id);";

		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		$lista = array();
		$i = 0;

		while($array = mysqli_fetch_array($select)){

			$lista[$i] = array(
					"id"=>$array['id'],
					"nome"=>$array['nome'],
					"valor_unitario"=>$array['valor_unitario'],
					"caminho_imagem"=>$array['caminho_imagem'],
					"qtd_dias"=>$array['qtd_dias'],
					"cor"=>$array['cor'],
					"tipo_dieta"=>$array['tipo_dieta'],
					"tipo"=>$array['tipo']
				);

			$i++;
		}

		echo json_encode($lista);
	}

	if(isset($_GET['listar_pratos_aprovados'])){

		$conexao = connect();

		$sql = "(select 
				p.prato_id as id,
				p.nome, 
				replace(concat('R$ ',round(p.valor_unitario,2)),'.',',') as valor_unitario, 
				substr(p.caminho_imagem,4) as caminho_imagem,
				'' as qtd_dias,
				'' as cor,
                '' as tipo_dieta,
                p.aprovacao_id,
                a.nome as aprovacao,
				'prato' as tipo
				from prato as p
				inner join aprovacao as a 
				on a.aprovacao_id = p.aprovacao_id 
                where a.aprovacao_id <> 1
                order by p.prato_id desc
				) 
				union
				(select 
				d.dieta_id, 
				d.nome, 
				replace(concat('R$ ',round(sum(p.valor_unitario),2)),'.',',') as valor_unitario,
				'' as caminho_imagem,
				(select count(distinct dia) from rel_dieta_prato where dieta_id = d.dieta_id) as qtd_dias,
				td.cor,
                td.nome as tipo_dieta,
                d.aprovacao_id,
                a.nome as aprovacao,
				'dieta' as tipo
				from dieta as d 
				inner join rel_dieta_prato as dp
				on dp.dieta_id = d.dieta_id 
				inner join prato as p
				on p.prato_id = dp.prato_id
				inner join tipo_dieta as td
				on d.tipo_dieta_id = td.tipo_dieta_id
				inner join aprovacao as a 
				on a.aprovacao_id = d.aprovacao_id 
                where a.aprovacao_id <> 1
				group by dieta_id
                order by d.dieta_id desc);";

		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		$lista = array();
		$i = 0;

		while($array = mysqli_fetch_array($select)){

			$lista[$i] = array(
					"id"=>$array['id'],
					"nome"=>$array['nome'],
					"valor_unitario"=>$array['valor_unitario'],
					"caminho_imagem"=>$array['caminho_imagem'],
					"qtd_dias"=>$array['qtd_dias'],
					"cor"=>$array['cor'],
					"tipo_dieta"=>$array['tipo_dieta'],
					"aprovacao_id"=>$array['aprovacao_id'],
					"aprovacao"=>$array['aprovacao'],
					"tipo"=>$array['tipo']
				);

			$i++;
		}

		echo json_encode($lista);
	}

	if(isset($_GET['listar_pratos_aprovados_administrativo'])){

		$conexao = connect();

		$sql = "(select 
				p.prato_id as id,
				p.nome, 
				replace(concat('R$ ',round(p.valor_unitario,2)),'.',',') as valor_unitario, 
				substr(p.caminho_imagem,4) as caminho_imagem,
				'' as qtd_dias,
				'' as cor,
                '' as tipo_dieta,
                p.aprovacao_id,
                a.nome as aprovacao,
				'prato' as tipo
				from prato as p
				inner join aprovacao as a 
				on a.aprovacao_id = p.aprovacao_id 
                order by p.prato_id desc
				) 
				union
				(select 
				d.dieta_id, 
				d.nome, 
				replace(concat('R$ ',round(sum(p.valor_unitario),2)),'.',',') as valor_unitario,
				'' as caminho_imagem,
				(select count(distinct dia) from rel_dieta_prato where dieta_id = d.dieta_id) as qtd_dias,
				td.cor,
                td.nome as tipo_dieta,
                d.aprovacao_id,
                a.nome as aprovacao,
				'dieta' as tipo
				from dieta as d 
				inner join rel_dieta_prato as dp
				on dp.dieta_id = d.dieta_id 
				inner join prato as p
				on p.prato_id = dp.prato_id
				inner join tipo_dieta as td
				on d.tipo_dieta_id = td.tipo_dieta_id
				inner join aprovacao as a 
				on a.aprovacao_id = d.aprovacao_id
				group by dieta_id
                order by d.dieta_id desc);";

		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		$lista = array();
		$i = 0;

		while($array = mysqli_fetch_array($select)){

			$lista[$i] = array(
					"id"=>$array['id'],
					"nome"=>$array['nome'],
					"valor_unitario"=>$array['valor_unitario'],
					"caminho_imagem"=>$array['caminho_imagem'],
					"qtd_dias"=>$array['qtd_dias'],
					"cor"=>$array['cor'],
					"tipo_dieta"=>$array['tipo_dieta'],
					"aprovacao_id"=>$array['aprovacao_id'],
					"aprovacao"=>$array['aprovacao'],
					"tipo"=>$array['tipo']
				);

			$i++;
		}

		echo json_encode($lista);
	}

	if(isset($_GET['avaliar_produto'])){

		$id = $_GET['id'];
		$tipo = $_GET['tipo'];
		$resposta = $_GET['resposta'];

		$conexao = connect();
		if($tipo == "prato"){
			$sql = "update prato set aprovacao_id = ".$resposta." where prato_id = ".$id.";";
		}else if($tipo == "dieta"){
			$sql = "update dieta set aprovacao_id = ".$resposta." where dieta_id = ".$id.";";
		}

		$update = mysqli_query($conexao, $sql);
		mysqli_close($conexao);

		$lista = array();
		$lista[0] = array("resultado"=>"1");

		echo json_encode($lista[0]);
	}


?>
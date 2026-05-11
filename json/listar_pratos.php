<?php 

	 require_once('../cms/php/geral.php');

		$conexao = connect();
		// $tipo_ingrediente_id = $_GET['tipo_ingrediente_id'];
		$tipo_dieta_id = "";

		if(isset($_GET['tipo_dieta_id'])){

			$teste = $_GET['tipo_dieta_id'];
			$tipo_dieta_id_prato="where p.tipo_dieta_id = ".$teste." and p.aprovacao_id = 2 ";
			$tipo_dieta_id_dieta="where d.tipo_dieta_id = ".$teste." and d.aprovacao_id = 2 " ;
		}else{
			$tipo_dieta_id_prato="where p.aprovacao_id = 2 ";
			$tipo_dieta_id_dieta="where d.aprovacao_id = 2 " ;
		}

		$sql = "(select 
				p.prato_id, 
				p.nome,
				p.valor_unitario,
				p.caminho_imagem,
				p.descricao,
				p.tipo_dieta_id,
				p.aprovacao_id,
				sum(i.kcal_por_100g) as kcal_por_100g, 
				sum(pi.qtd) as peso, 
				round((sum(pi.qtd)/100)*sum(i.kcal_por_100g)) as kcal_prato, 
				count(pp.prato_id) as esta_promocao,
				round(p.valor_unitario - p.valor_unitario * (pr.porcentagem_desc / 100),2) as valor_desconto,
				'' as tipo_dieta,
				'' as qtd_dias,
                '' as cor,
				'prato' as tipo
				from prato as p 
				inner join rel_prato_ingrediente as pi 
				on pi.prato_id = p.prato_id 
				inner join ingrediente as i 
				on pi.ingrediente_id = i.ingrediente_id 
				left join rel_prato_promocao as pp
				on pp.prato_id = p.prato_id
				left join promocao as pr
				on pr.promocao_id = pp.promocao_id 
				".$tipo_dieta_id_prato. "
				group by p.prato_id 
				order by kcal_prato)
				union
				(select 
				d.dieta_id,
				d.nome,
				sum(distinct p.valor_unitario) as valor_unitario,
				'' as caminho_imagem,
				d.descricao,
				d.tipo_dieta_id,
				d.aprovacao_id,
				sum(i.kcal_por_100g) as kcal_por_100g,
				sum(pi.qtd) as peso,
				(select sum(kcal_dieta) from (select 
				round((sum(pi.qtd)/100)*sum(i.kcal_por_100g)) as 'kcal_dieta'
				from dieta as d
				inner join rel_dieta_prato as dp
				on (dp.dieta_id = d.dieta_id)
				inner join prato as p
				on (dp.prato_id = p.prato_id)
				inner join rel_prato_ingrediente as pi
				on (pi.prato_id = p.prato_id)
				inner join ingrediente as i
				on (i.ingrediente_id = pi.ingrediente_id)
				group by p.prato_id) as a) as kcal_dieta,
				'0' as esta_promocao,
				NULL as valor_desconto,
				td.nome as tipo_dieta,
				count(distinct dp.dia) as qtd_dias,
                td.cor as cor,
				'dieta' as tipo
				from dieta as d
				inner join rel_dieta_prato as dp
				on (dp.dieta_id = d.dieta_id)
				inner join prato as p
				on (dp.prato_id = p.prato_id)
				inner join rel_prato_ingrediente as pi
				on (pi.prato_id = p.prato_id)
				inner join ingrediente as i
				on (i.ingrediente_id = pi.ingrediente_id)
				inner join tipo_dieta as td
				on (td.tipo_dieta_id = d.tipo_dieta_id) 
				".$tipo_dieta_id_dieta. "
				group by dieta_id);";
				
		$select = mysqli_query($conexao, $sql);
		mysqli_close($conexao);
		$i = 0;
		$lista = array();


		while($array = mysqli_fetch_array($select)){
			$lista[$i] = array(
				'prato_id' => utf8_encode($array['prato_id']),
			 	'nome' => $array['nome'],
			 	'valor_unitario' => utf8_encode($array['valor_unitario']),
			 	'valor_desconto' => utf8_encode($array['valor_desconto']),
			 	'caminho_imagem' => utf8_encode(substr($array['caminho_imagem'], 3)),
			 	'descricao' => $array['descricao'],
			 	'tipo_dieta_id' => utf8_encode($array['tipo_dieta_id']),
			 	'kcal_por_100g' => utf8_encode($array['kcal_por_100g']),
			 	'peso' => utf8_encode($array['peso']),
			 	'kcal_prato' => utf8_encode($array['kcal_prato']),
			 	'esta_promocao' => utf8_encode($array['esta_promocao']),
			 	'tipo_dieta'=>utf8_encode($array['tipo_dieta']),
			 	'qtd_dias'=>utf8_encode($array['qtd_dias']),
			 	'cor'=>utf8_encode($array['cor']),
			 	'tipo'=>utf8_encode($array['tipo'])
			 	);
			$i++;
		}

		echo json_encode($lista);



 ?>
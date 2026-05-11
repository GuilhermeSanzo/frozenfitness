<?php

	require_once('../cms/php/geral.php');

	$conexao = connect();

	if (!empty($_GET['prato_id'])) {
		$prato_id = $_GET['prato_id'];

		 $sql_prato = "select 
                  p.prato_id, 
                  p.nome,
                  p.valor_unitario,
                  p.caminho_imagem,
                  p.descricao,
                  p.tipo_dieta_id,
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
                  where p.prato_id = $prato_id
                  group by p.prato_id 
                  order by kcal_prato";
		$select_prato = mysqli_query($conexao, $sql_prato);

		$array_prato = mysqli_fetch_array($select_prato);
		$lista_prato = array();

            if($array_prato['esta_promocao'] > 0){
                  $preco = $array_prato["valor_desconto"];
            }else{
                  $preco = $array_prato["valor_unitario"];
            }
		$lista_prato[0] = array(
			"valor_unitario" => $preco
			);

		echo json_encode($lista_prato[0]);
	}

	if (!empty($_GET['dieta_id'])) {
		$dieta_id = $_GET['dieta_id'];

		$sql_dieta = "select 
                  d.dieta_id,
                  d.nome,
                  sum(distinct p.valor_unitario) as valor_unitario,
                  '' as caminho_imagem,
                  d.descricao,
                  d.tipo_dieta_id,
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
                  where d.dieta_id = $dieta_id
                  group by dieta_id";
		$select_dieta = mysqli_query($conexao, $sql_dieta);

		$array_dieta = mysqli_fetch_array($select_dieta);
		$lista_dieta = array();
		$lista_dieta[0] = array(
			"valor_unitario" => $array_dieta['valor_unitario']
			);

		echo json_encode($lista_dieta[0]);
	}



	mysqli_close($conexao);

?>

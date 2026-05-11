<?php

	require_once('cms/php/geral.php');

	function Listar($dieta_id) {
		$conexao = connect();

		$sql = "select 
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
                (select round(sum(kcal_dieta/count(distinct dp.dia)),2) from (select 
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
				group by p.prato_id) as a) as kcal_diaria,
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
                where d.dieta_id = ".$dieta_id."
				group by d.dieta_id
                limit 1;";
		$select = mysqli_query($conexao,$sql);

		while($array = mysqli_fetch_array($select)){

			if($array['esta_promocao'] > 0){
				$valor_unitario = $array['valor_desconto'];
			}else{
				$valor_unitario = $array['valor_unitario'];
			}

		echo'<div class="cx_produto">
			<div class="box_dieta" style="background-color:'.$array['cor'].'">
			  		<div class="box_dias_dieta">
			  			Quantidade de dias:<br>
			   	 		<span class="dias_dieta">'.$array['qtd_dias'].' Dia(s)</span>
			  			</div>
			      	<div class="box_tipo_dieta">
			          '.$array['tipo_dieta'].'
			      </div>
			      	<div class="box_dias_dieta">
			  			Apenas<br>
			   	 		<span class="dias_dieta">'.$array['kcal_diaria'].' kcal diárias</span><br>
			   	 		<span style="font-size:10pt">Em média</span>
			  		</div>
				</div>
			<div class="produto_descricao">
				<div class="produto_descricao_cima">
					<h1>'.$array["nome"].'</h1>
					<p>'.$array["descricao"].'</p>
					<span>'.$array["kcal_dieta"].' Kcal</span>
				</div>
				<div class="produto_descricao_baixo">
					<h1>R$ '.str_replace(".",",",$valor_unitario).'</h1>
					<a href="php/add_carrinho.php?action=insert&dieta_id='.$array["dieta_id"].'"><p>Comprar</p></a>
				</div>
			</div>
		</div>
		<div class="titulo_p_pratos"><h2 class="produto_preparo_titulo">PRATOS DA DIETA</h2></div>
		<div class="box_pratos_da_dieta">
		';
		};

		/* Mostrando informações sobre os ingredientes */
		$sql2 = "select
				p.prato_id,
				p.nome,
                h.nome as horario_dia,
				p.valor_unitario,
				substr(p.caminho_imagem,4) as caminho_imagem,
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
				'prato' as tipo,
                dp.dia
				from prato as p
				inner join rel_prato_ingrediente as pi
				on pi.prato_id = p.prato_id
				inner join ingrediente as i
				on pi.ingrediente_id = i.ingrediente_id
				left join rel_prato_promocao as pp
				on pp.prato_id = p.prato_id
				left join promocao as pr
				on pr.promocao_id = pp.promocao_id
				inner join rel_dieta_prato as dp
				on dp.prato_id = p.prato_id
                inner join horario_do_dia as h
                on dp.horario_do_dia_id = h.horario_do_dia_id
				where dp.dieta_id = ".$dieta_id."
				group by p.prato_id
				order by kcal_prato";

		$select2 = mysqli_query($conexao,$sql2);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select2)){
		echo '
			<div class="box_prato_dieta">
				  <div class="box_dia_dieta">
				      '.$array['dia'].'º Dia
				      </div>

				  <div class="box_img_prato" style="background-image:url(cms/'.$array['caminho_imagem'].')">

				      </div>

				  <div class="box_titulo_prato">
				  		'.$array['nome'].'
				      </div>

				  <div class="box_horario_do_dia">
				  		'.$array['horario_dia'].'
				      </div>

				  <div class="box_kcal_prato">
				  		'.$array['kcal_prato'].' kcal
				      </div>

				  <div style="clear:both">
				  </div>
			</div>
		';
		}

		echo '</div>';

	}

?>

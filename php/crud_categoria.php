<?php

	require_once('cms/php/geral.php');

	/* Função para listar */
	function Listar() {
		$conexao = connect();
	    $sql = "select tipo_dieta_id, nome from tipo_dieta";
	    $select = mysqli_query($conexao, $sql);

	    while ($array = mysqli_fetch_array($select)) {

			echo'
			<div class="box_conteudo_menu_lateral">
				<div class="item_menu_lateral">
					<a class="link_menu_lateral" href="categoria.php?tipo_dieta_id='.$array["tipo_dieta_id"].'">'.$array["nome"].'</a>
				</div>
			</div>
			';

	    }

	    mysqli_close($conexao);
	}

	/* Função para listar os produtos */
	function ListarProdutosCategoria($tipo_dieta_id) {
		$conexao = connect();

		$tipo_dieta_id_prato="where p.tipo_dieta_id = ".$tipo_dieta_id." and p.aprovacao_id=2";
		$tipo_dieta_id_dieta="where d.tipo_dieta_id = ".$tipo_dieta_id." and d.aprovacao_id=2";

		$sql = "(select
				p.prato_id,
				concat(substring(p.nome,1,20),'...') as nome,
				p.valor_unitario,
				p.caminho_imagem,
				concat(substring(p.descricao,1,45),'...') as descricao,
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
				".$tipo_dieta_id_prato. "
				group by p.prato_id
				order by kcal_prato)
				union
				(select
				d.dieta_id,
				concat(substring(d.nome,1,20),'...') as nome,
				sum(distinct p.valor_unitario) as valor_unitario,
				'' as caminho_imagem,
				concat(substring(p.descricao,1,45),'...') as descricao,
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
				".$tipo_dieta_id_dieta. "
				group by dieta_id);";

	    $select = mysqli_query($conexao, $sql);

	    while ($array = mysqli_fetch_array($select)) {
				$prato_id = $array['prato_id'];
	    	$promocao="";

	    	if($array['esta_promocao'] > 0){
	    		$promocao = '<div class="promocao"></div>';
	    		$valor_unitario = $array["valor_desconto"];
	    	}else{
	    		$valor_unitario = $array['valor_unitario'];
	    	}

	    	if($array['tipo'] == "prato"){
	    		echo '<div class="box_produto">'.
	  								$promocao.
									'<div class="box_img_produto" style="background-image:url(cms/'.substr($array["caminho_imagem"], 3).')">'.
									'</div>'.
									'<div class="box_titulo_produto">'
										.$array["nome"].
									'</div>'.
									'<div class="box_descricao_produto">'
										.$array["descricao"].
									'</div>'.
									'<div class="preco_kcal">'.
										'<div class="preco">'.
											'R$ '.str_replace(".", ",", $valor_unitario).
										'</div>'.
										'<div class="kcal">'
											.$array["kcal_prato"].'kcal'.
										'</div>'.
										'<div style="clear:both"></div>'.
									'</div>'.
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='.$prato_id.'">'.
										'<div class="box_botao_produto" id="comprar">'.
											'Comprar'.
										'</div>'.
									'</a>'.
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='.$array["prato_id"].'">'.
										'<div class="box_botao_produto" id="ver_detalhes">'.
											'Ver Detalhes'.
										'</div>'.
									'</a>'.
								'</div>';
	    	}else if($array['tipo'] == "dieta"){
	    		echo '<div class="box_produto">'.
	  								$promocao.
									'<div class="box_dieta" style="background-color:'.$array['cor'].'">'.
								  		'<div class="box_dias_dieta">'.
								  			'Quantidade de dias:<br>'.
								   	 		'<span class="dias_dieta">'.$array['qtd_dias'].' Dia(s)</span>'.
								  		'</div>'.
								      	'<div class="box_tipo_dieta">'.
								          $array['tipo_dieta'].
						      			'</div>'.
						      		'</div>'.
									'<div class="box_titulo_produto">'
										.$array["nome"].
									'</div>'.
									'<div class="box_descricao_produto">'
										.$array["descricao"].
									'</div>'.
									'<div class="preco_kcal">'.
										'<div class="preco">'.
											'R$ '.str_replace(".", ",", $valor_unitario).
										'</div>'.
										'<div class="kcal">'
											.$array["kcal_prato"].'kcal'.
										'</div>'.
										'<div style="clear:both"></div>'.
									'</div>'.
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='.$prato_id.'">'.
										'<div class="box_botao_produto" id="comprar">'.
											'Comprar'.
										'</div>'.
									'</a>'.
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='.$array["prato_id"].'">'.
										'<div class="box_botao_produto" id="ver_detalhes">'.
											'Ver Detalhes'.
										'</div>'.
									'</a>'.
								'</div>';
	    	}



	    }
	}


?>

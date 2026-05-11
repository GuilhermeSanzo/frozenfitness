<?php

	require_once('cms/php/geral.php');

	/*  */
	function ListarPromocoes() {
		$conexao = connect();
	    $sql = "select
				p.*,
				concat(substring(p.nome,1,20),'...') as nome_prato,
				concat(substring(p.descricao,1,45),'...') as descricao_prato,
				sum(i.kcal_por_100g) as kcal_por_100g,
				sum(pi.qtd) as peso, round((sum(pi.qtd)/100)*sum(i.kcal_por_100g)) as kcal_prato,
				count(pp.prato_id) as esta_promocao,
				round(p.valor_unitario - p.valor_unitario * (pr.porcentagem_desc / 100),2) as valor_desconto
				from prato as p
				inner join rel_prato_ingrediente as pi
				on pi.prato_id = p.prato_id
				inner join ingrediente as i
				on pi.ingrediente_id = i.ingrediente_id
				left join rel_prato_promocao as pp
				on pp.prato_id = p.prato_id
				left join promocao as pr
				on pr.promocao_id = pp.promocao_id
				where pr.promocao_id = pp.promocao_id 
				and p.aprovacao_id = 2
				group by p.prato_id
				order by kcal_prato;";
	    $select = mysqli_query($conexao, $sql);

	    while ($array = mysqli_fetch_array($select)) {

				$prato_id = $array['prato_id'];

				echo '<div class="box_produto">'.
	  								'<div class="promocao"></div>'.
									'<div class="box_img_produto" style="background-image:url(cms/'.substr($array["caminho_imagem"], 3).')">'.
									'</div>'.
									'<div class="box_titulo_produto">'
										.$array["nome_prato"].
									'</div>'.
									'<div class="box_descricao_produto">'
										.$array["descricao_prato"].
									'</div>'.
									'<div class="preco_kcal">'.
										'<div class="preco">'.
											'R$ '.str_replace(".", ",", $array["valor_desconto"]).
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


	    }
	}

?>

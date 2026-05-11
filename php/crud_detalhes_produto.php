<?php

	require_once('cms/php/geral.php');

	function Listar($prato_id) {
		$conexao = connect();

		/* Mostrando informações sobre o prato */
		$sql = "select 
				p.*, 
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
				where p.prato_id = ".$prato_id."
				group by p.prato_id 
				order by kcal_prato;";
		$select = mysqli_query($conexao,$sql);

		while($array = mysqli_fetch_array($select)){

			if($array['esta_promocao'] > 0){
				$valor_unitario = $array['valor_desconto'];
			}else{
				$valor_unitario = $array['valor_unitario'];
			}

		echo'<div class="cx_produto">
			<img src="cms/'.substr($array["caminho_imagem"], 3).'" class="produto_img">
			<div class="produto_descricao">
				<div class="produto_descricao_cima">
					<h1>'.$array["nome"].'</h1>
					<p>'.$array["descricao"].'</p>
					<span>'.$array["kcal_prato"].' Kcal</span>
				</div>
				<div class="produto_descricao_baixo">
					<h1>R$ '.str_replace(".",",",$valor_unitario).'</h1>
					<a href="php/add_carrinho.php?action=insert&prato_id='.$prato_id.'"><p>Comprar</p></a>
				</div>
			</div>
		</div>
		<h2 class="produto_preparo_titulo">INGREDIENTES</h2>
		';
		};

		/* Mostrando informações sobre os ingredientes */
		$sql2 = "select p.nome as 'nome_prato', p.descricao, p.valor_unitario, p.caminho_imagem as 'imagem_prato',
					i.nome as 'nome_ingrediente', i.caminho_imagem as 'imagem_ingrediente',	i.kcal_por_100g,
					u.abreviatura, ti.nome as 'nome_tipo_ingrediente'
					from ingrediente as i
					inner join rel_prato_ingrediente as rel on i.ingrediente_id = rel.ingrediente_id
					inner join prato as p on rel.prato_id = p.prato_id
					inner join unidade as u on i.unidade_id = u.unidade_id
					inner join tipo_ingrediente as ti on i.tipo_ingrediente_id = ti.tipo_ingrediente_id
					where p.prato_id = ".$prato_id.";";

		$select2 = mysqli_query($conexao,$sql2);
		mysqli_close($conexao);
		while($array = mysqli_fetch_array($select2)){
		echo '
		<div class="produto_preparo">
				<table class="tbl_ingrediente">
					<tr>
						<td><h2>'.$array["nome_ingrediente"].'</h2></td>

						<td><img class="img_ingrediente" src="cms/'.$array["imagem_ingrediente"].'"></td>
					</tr>
					<tr>
						<td>Tipo de Ingrediente: </td>
						<td>'.$array["nome_tipo_ingrediente"].'</td>
					</tr>
					<tr>
						<td>Tipo de Peso: </td>
						<td>'.$array["abreviatura"].'</td>
					</tr>
					<tr>
						<td>Kcal por 100g: </td>
						<td>'.$array["kcal_por_100g"].'</td>
					</tr>
				</table>
		</div>
		';
		}

	}

?>

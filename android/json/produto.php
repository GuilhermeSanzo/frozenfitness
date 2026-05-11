<?php
	
	require_once('../../cms/php/geral.php');
	// error_reporting(0);
	
	if(isset($_GET['pedido_id'])){

		$pedido_id = $_GET['pedido_id'];
		$lista = array();
		$conexao = connect();

		$sql = "(select concat(substr(pr.nome,1,21)) as nome , pr.descricao, substr(pr.caminho_imagem,4) as caminho_imagem, pr.valor_unitario,pp.qtde, 'prato' as tipo
				from pedido as p 
				inner join rel_prato_pedido as pp
				on pp.pedido_id = p.pedido_id
				inner join prato as pr
				on pr.prato_id = pp.prato_id
				where p.pedido_id = ".$pedido_id.")
				union
				(select d.nome, d.descricao,'' as caminho_imagem, sum(pr.valor_unitario) as valor_unitario, dp.qtde, 'dieta' as tipo
				from pedido as p 
				inner join rel_dieta_pedido as dp
				on dp.pedido_id = p.pedido_id
				inner join dieta as d
				on d.dieta_id = dp.dieta_id
				inner join rel_dieta_prato as dpr
				on dpr.dieta_id = d.dieta_id
				inner join prato as pr
				on pr.prato_id = dpr.prato_id
				where p.pedido_id = ".$pedido_id."
				group by d.dieta_id);";
		
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		
		$lista = array();
		$cont = 0;
		while($array = mysqli_fetch_array($select)){

			$nome = $array['nome'];
			if(strlen($nome) >= 21){
				$nome = $array['nome']."...";
			}

			$lista[$cont] = array(
			"nome" => $nome,
			"descricao" => $array['descricao'],
			"caminho_imagem" => "http://www.ypfrozen.com.br/cms/".$array['caminho_imagem'],
			"preco" => "R$ ".$array['valor_unitario'],
			"qtde" => $array['qtde'],
			"tipo" => $array['tipo']
			);
			$cont++;
		}
		echo json_encode($lista);
	} 
?>


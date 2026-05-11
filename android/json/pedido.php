<?php
	
	require_once('../../cms/php/geral.php');
	// error_reporting(0);
	
	if(isset($_GET['usuario_id'])){

		if($_GET['usuario_id'] != ""){
			$usuario_id = $_GET['usuario_id'];
		}
		
		$modo = $_GET['modo'];
		$lista = array();
		$conexao = connect();

		if($modo == 1){
			$sql = "select p.pedido_id,p.status_id,concat('R$ ',p.total_pedido) as total_pedido,s.nome,date_format(p.dt_entrega_solic,'%d/%m/%y') as dt_entrega_solic
				from pedido as p
				inner join status as s
				on s.status_id = p.status_id
				inner join usuario as u
				on u.usuario_id = p.cliente_id
				where u.usuario_id = ".$usuario_id."
				order by p.pedido_id desc;";
		}else if($modo == 2){
			$sql = "select p.pedido_id,p.status_id,concat('R$ ',p.total_pedido) as total_pedido,s.nome,date_format(p.dt_entrega_solic,'%d/%m/%y') as dt_entrega_solic
				from pedido as p
				inner join status as s
				on s.status_id = p.status_id
				inner join usuario as u
				on u.usuario_id = p.cliente_id
				where u.usuario_id = ".$usuario_id." 
				and s.status_id = 1 
				order by p.pedido_id desc;";
		}else if($modo == 3){
			$sql = "select p.pedido_id,p.status_id,concat('R$ ',p.total_pedido) as total_pedido,s.nome,date_format(p.dt_entrega_solic,'%d/%m/%y') as dt_entrega_solic
				from pedido as p
				inner join status as s
				on s.status_id = p.status_id
				inner join usuario as u
				on u.usuario_id = p.cliente_id
				where u.usuario_id = ".$usuario_id." 
				and s.status_id = 6 
				order by p.pedido_id desc;";
		}else if($modo == 4){
			$sql = "select p.pedido_id ,
				concat('R$ ',p.total_pedido) as total_pedido, 
				date_format(p.dt_entrega_solic,'%d/%m/%y') as dt_entrega_solic, 
				p.status_id, 
				s.nome
				from pedido as p
				inner join caminhao as c
				on c.caminhao_id = p.caminhao_id
				inner join motorista as m
				on m.motorista_id = c.motorista_id
				inner join status as s
				on s.status_id = p.status_id
				where m.motorista_id = ".$usuario_id." and p.status_id = 6 
				order by p.pedido_id desc;";
		}
		

		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		
		$lista = array();
		$cont = 0;

		while($array = mysqli_fetch_array($select)){
			$lista[$cont] = array(
			"pedido_id" => $array['pedido_id'],
			"total_pedido" => $array['total_pedido'],
			"dt_entrega_solic" => $array['dt_entrega_solic'],
			"status_id" => $array['status_id'],
			"nome_status" => $array['nome']
			);

			$cont++;
		}
		echo json_encode($lista);
	} 
?>


<?php 
	
	//Incluindo o arquivo que conterá algumas funções globais para o sistema, como iniciação de variáveis de Sessão e Conexão com Banco de dados.
	require_once('geral.php');

	if(isset($_GET['inserir_promocao'])){
		$prato_id = $_GET['prato_id'];
		$promocao_id = $_GET['promocao_id'];
		$conexao = connect();
		$sql = "select count(pp.prato_id) as esta_promocao, pp.* from rel_prato_promocao as pp where pp.prato_id = ".$prato_id.";";
		$select = mysqli_query($conexao,$sql);
		$array = mysqli_fetch_array($select);
		mysqli_close($conexao);
		if($array['esta_promocao'] != 0){
			$sql = "update rel_prato_promocao set promocao_id = ".$promocao_id." where rel_prato_promocao_id = ".$array['rel_prato_promocao_id'];
		}else{
			$sql = "insert into rel_prato_promocao (prato_id,promocao_id) values (".$prato_id.",".$promocao_id.")";
		}

		$conexao = connect();
		$insert = mysqli_query($conexao,$sql);

		$lista = array();
		$lista[0] = array("resultado"=>"1");

		echo json_encode($lista[0]);
	}

	if(isset($_GET['remover_promocao'])){
		$prato_id = $_GET['prato_id'];
		$promocao_id = $_GET['promocao_id'];
		$conexao = connect();
		$sql = "delete from rel_prato_promocao where prato_id = ".$prato_id;
		$delete = mysqli_query($conexao,$sql);

		$lista = array();
		$lista[0] = array("resultado"=>"1");

		echo json_encode($lista[0]);
	}

	function Listar(){
		$conexao = connect();
		$conexao2 = connect();
		$sql = "select 
				p.*, 
				p.nome as nome_prato,
				concat(substring(p.descricao,1,45),'...') as descricao_prato,
				sum(i.kcal_por_100g) as kcal_por_100g, 
				sum(pi.qtd) as peso, round((sum(pi.qtd)/100)*sum(i.kcal_por_100g)) as kcal_prato, 
				count(pp.prato_id) as esta_promocao,
				round(p.valor_unitario - p.valor_unitario * (pr.porcentagem_desc / 100),2) as valor_desconto,
                pr.nome as nome_promocao,
                pr.promocao_id
				from prato as p 
				inner join rel_prato_ingrediente as pi 
				on pi.prato_id = p.prato_id 
				inner join ingrediente as i 
				on pi.ingrediente_id = i.ingrediente_id 
				left join rel_prato_promocao as pp
				on pp.prato_id = p.prato_id
				left join promocao as pr
				on pr.promocao_id = pp.promocao_id
				group by p.prato_id;";
		$sql2 = "select * from promocao";
		$select = mysqli_query($conexao,$sql);
		$select2 = mysqli_query($conexao2,$sql2);
		mysqli_close($conexao);
		mysqli_close($conexao2);

		$sem_promocao = "<option value=''>Escolha uma promoção</option><option value=''>---</option>";

		$lista = array();
		$i=0;
		while($array2 = mysqli_fetch_array($select2)){
			$lista[$i] = array(
				"promocao_id"=>$array2['promocao_id'],
				"nome"=>$array2['nome']
				);
			$i++;
		}

		$index = 0;
		while($array = mysqli_fetch_array($select)){
			echo "<tr>";
			echo "<td>".$array['nome']."</td>";
			echo "<td><img style='width:300px;heigth:120px' src='".substr($array['caminho_imagem'], 3)."'></td>";
			echo "<td>".$array['valor_unitario']."</td>";
			echo "<td><select id='select_promocao".$index."' class='select_promocao' prato_id='".$array['prato_id']."' nome_prato='".$array['nome_prato']."'>";

			//Verificando se o prato já possui uma promoção na hora de listar
			if($array['nome_promocao']!=""){
				echo "<option value='".$array['promocao_id']."' nome_promocao='".$array['nome_promocao']."'>".$array['nome_promocao']."</option><option value=''>---</option>";
			}else{
				echo $sem_promocao;
			}

			for ($i=0; $i < mysqli_num_rows($select2); $i++) { 

				echo "<option value='".$lista[$i]['promocao_id']."' nome_promocao='".$lista[$i]['nome']."'>".$lista[$i]['nome']."</option>";

			}
			echo "<select/></td>";
			echo "<td><a class='remover_promocao' prato_id='".$array['prato_id']."' nome_prato='".$array['nome_prato']."' promocao_id='".$array['promocao_id']."' nome_promocao='".$array['nome_promocao']."'href='#'>Remover Promoção</a></td>";
			echo "</tr>";
			$index++;
		}


	}
	
?>
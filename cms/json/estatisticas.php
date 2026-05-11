<?php 
	
	require_once('php/geral.php');

	
		$conexao = connect();
		$sql = "select p.nome, p.qtde_visualizacoes from prato as p order by qtde_visualizacoes desc limit 5;";
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);

		$i = 0;
		while($array = mysqli_fetch_array($select)){

			echo "<div id='nome_view_produto".$i."' style='display:none'>".$array['nome']."</div>";
			echo "<div id='view_produto".$i."' style='display:none'>".$array['qtde_visualizacoes']."</div>";

			$i++;
		}
	
	


?>


<?php

require_once('php/geral.php');


function Listar(){

	$conexao = connect();

	$visualizado = "lido";

	$sql = "select fc.fale_conosco_id, fc.nome, fc.email, fc.titulo, fc.mensagem, fc.status, cfc.nome as 'categoria' from faleconosco as fc
					inner join categoria_fale_conosco as cfc on (fc.categoria = cfc.categoria_id) order by fc.fale_conosco_id desc;";
	$select = mysqli_query($conexao,$sql);

	mysqli_close($conexao);
	while($array = mysqli_fetch_array($select)){

		if($array['status'] == 1) {
			$visualizado = "lido";
		} else {
			$visualizado = "nao_lido";
		}
		
		echo "<tr class='expand $visualizado'>";
		echo "<td>".$array['fale_conosco_id']."</td>";
		echo "<td>".$array['email']."</td>";
		echo "<td>".$array['titulo']."</td>";
		echo "<td>".$array['categoria']."</td>";
		echo
		"<td>
			<a href='visualizacao_fale_conosco.php?modo=detalhe&id=".$array['fale_conosco_id']."#ponto'><span class='detail'></span></a>
			<a href='visualizacao_fale_conosco.php?modo=excluir&id=".$array['fale_conosco_id']."'><span class='remove'></span></a>
		</td>";
		echo "</tr>";
	}
}

function ListarDetalhado($id) {

	$conexao = connect();

	$sql = "select fc.fale_conosco_id, fc.nome, fc.email, fc.titulo, fc.mensagem, cfc.nome as 'categoria' from faleconosco as fc
					inner join categoria_fale_conosco as cfc on (fc.categoria = cfc.categoria_id)
					where fale_conosco_id =".$id." order by fc.fale_conosco_id desc;";
	$select = mysqli_query($conexao, $sql);

	$change_status = "update faleconosco set status = 1 where fale_conosco_id =".$id;
	mysqli_query($conexao, $change_status);

	mysqli_close($conexao);

	while($array = mysqli_fetch_array($select)){

		

		echo '
		<tr>
			<td class="popup_titulo">ID: </td>
			<td class="popup_resultado"><input class="input_resultado" type="text" value="'.$array["fale_conosco_id"].'" disabled></td>
		</tr>
		<tr>
			<td class="popup_titulo">Nome: </td>
			<td class="popup_resultado"><input class="input_resultado" type="text" value="'.$array["nome"].'" disabled></td>
		</tr>
		<tr>
			<td class="popup_titulo">Email: </td>
			<td class="popup_resultado"><input class="input_resultado" type="text" value="'.$array["email"].'" disabled></td>
		</tr>
		<tr>
			<td class="popup_titulo">Título: </td>
			<td class="popup_resultado"><input class="input_resultado" type="text" value="'.$array["titulo"].'" disabled></td>
		</tr>
		<tr>
			<td class="popup_titulo">Mensagem: </td>
			<td class="popup_resultado"><textarea class="textarea_resultado" disabled>"'.$array["mensagem"].'"</textarea></td>
		</tr>
		<tr>
			<td class="popup_titulo">Categoria: </td>
			<td class="popup_resultado"><input class="input_resultado" type="text" value="'.$array["categoria"].'" disabled></td>
		</tr>
		<tr>
			<td class="popup_titulo">Opção: </td>
			<td class="popup_resultado">
				<a class="popup_excluir_link" href="visualizacao_fale_conosco.php?modo=excluir&id='.$array['fale_conosco_id'].'">
					<div class="popup_excluir"><p>Excluir</p></div>
				</a>
			</td>
		</tr>
		';
	}

}

function Buscar($id){
	$conexao = connect();
	$sql = "select fale_conosco_id, nome, email, titulo, mensagem, categoria from faleconosco
	where fale_conosco_id = ".$id;
	$select = mysqli_query($conexao,$sql);
	mysqli_close($conexao);
	$array = mysqli_fetch_array($select);
	return $array;
}

function Excluir($id){
	$conexao = connect();
	$sql = "select * from faleconosco;";
	$select = mysqli_query($conexao,$sql);
	$array = mysqli_fetch_array($select);
	mysqli_close($conexao);

	$conexao = connect();
	$sql = "delete from faleconosco where fale_conosco_id = ".$id;
	$delete = mysqli_query($conexao,$sql);
	mysqli_close($conexao);

	header("location:visualizacao_fale_conosco.php");
}

?>

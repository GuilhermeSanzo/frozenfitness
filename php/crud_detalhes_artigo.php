<?php

  require_once('cms/php/geral.php');

  function Listar($artigo_id) {
    $conexao = connect();
    $sql = "select artigo_id, titulo, conteudo, caminho_imagem as 'imagem', day(artigo_data) as 'dia', case month(artigo_data) WHEN 1 THEN 'Jan'
		WHEN 2 THEN 'Fev'
		WHEN 3 THEN 'Mar'
		WHEN 4 THEN 'Abr'
		WHEN 5 THEN 'Mai'
		WHEN 6 THEN 'Jun'
		WHEN 7 THEN 'Jul'
		WHEN 8 THEN 'Agoo'
		WHEN 9 THEN 'Set'
		WHEN 10 THEN 'Out'
		WHEN 11 THEN 'Nov'
		WHEN 12 THEN 'Dez'
		END AS 'mes', autor from artigo where artigo_id = ".$artigo_id.";";
	$select = mysqli_query($conexao, $sql);
    while ($array = mysqli_fetch_array($select)) {

      echo'
			<div class="box_artigo">
				<div class="box_artigo_title_data">
					<div class="box_data">
						<div class="box_dia">'.$array["dia"].'</div>
						<div class="box_mes">'.$array["mes"].'</div>
					</div>
					<div class="box_title_autor">
						<div class="box_title">'.$array["titulo"].'</div>
						<div class="box_autor">
							<div class="box_foto_autor"></div>
							<div class="box_nome_autor">'.$array["autor"].'</div>
							<div style="clear:both"></div>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="box_texto_foto_artigo">
					<div class="box_texto_lermais_artigo">
						<div class="box_texto_artigo">
							<img class="box_foto_artigo" src="cms/'.$array["imagem"].'" alt="'.$array["titulo"].'">
							<div class="box_texto_completo">
								'.$array["conteudo"].'
							</div>
						</div>
					</div>
				</div>
			</div>
      ';
    }
    mysqli_close($conexao);

  }

?>

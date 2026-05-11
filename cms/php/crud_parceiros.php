<?php 

	require_once('cms/php/geral.php');

	/*  */
	function Listar() {
		$conexao = connect();
	    $sql = "select p.parceiro_id,p.nome as parceiro,p.caminho_imagem,p.telefone,e.logradouro,e.nome, e.numero,e.cep,e.bairro,e.cidade,e.estado,p.link
				from parceiro as p 
				inner join endereco as e 
				on (p.endereco_id = e.endereco_id)
		";
	    $select = mysqli_query($conexao, $sql);

	    while ($array = mysqli_fetch_array($select)) {
	    	echo'
	    		<div class="parceiros">
					<div class="img_parceiro" style="background-image:url(cms/'.$array["caminho_imagem"].')" alt="Coca-Cola">
					</div>
				<div class="parceiros_descricao">
					<p>
						'.$array["logradouro"]. ': ' .$array["nome"]. ','.$array["numero"].' - '.$array["bairro"].' - '.$array["cidade"].' - '.$array["estado"].' - '.$array["cep"].'
					</p>
				</div>
				<div class="parceiros_link">
					<a href="'.$array["link"].'"><p>Acesse o site</p></a>
				</div>
				</div>
			';
	    }
	}

?>
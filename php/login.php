<?php

	require_once('../cms/php/geral.php');

	$conexao = connect();

	/* Verificando se a sessão já foi iniciada */
	if(!isset($_SESSION)) {
		session_start();
	}

	if (isset($_POST["btn_login"])) {

		// Antiga maneira de recuperar os dados do form
		// $email = $_POST['txt_email'];
		// $senha = $_POST['txt_senha'];

		// Limpando caracteres da string
		$email = preg_replace(array('/[^a-z0-9,@,.]/i', '/[-]+/') , '', $_POST['txt_email']);
		$senha = preg_replace(array('/[^A-Za-z0-9, !,@,#,$,%,&,*,. ]/i', '/[-]+/') , '', $_POST['txt_senha']);

		// Verificando se o retorno é vazio
		if (!empty($email) & !empty($senha)) {
			$sql = "select usuario_id, nome, sobre_nome, email, senha, tipo_usuario_id, caminho_imagem from usuario where email = '".$email."' and senha = '".$senha."' ";
			$verificacao = mysqli_query($conexao, $sql);

			if ($rs = mysqli_fetch_array($verificacao)) {
				$_SESSION["nome"] = $rs["nome"];
				$_SESSION["imagem"] = $rs["caminho_imagem"];
				$_SESSION["usuario_id"] = $rs["usuario_id"];
				$_SESSION["tipo_usuario_id"] = $rs["tipo_usuario_id"];
				/* Verificando se o usuário é funcionário */
				if ($rs["tipo_usuario_id"] != "1") {
					/* Vai para o CMS */
					header('location:../cms/index.php');
				} else {
					/* Codigo inserido para voltar na página anterior*/
					header('location:' . $_SERVER['HTTP_REFERER']);
				}
			} else {
				echo("<script>alert('O nome de usuario ou a senha está errada!')</script>");
				header("Refresh:0; url=". $_SERVER['HTTP_REFERER']."");
			}
		// Caso esteja vazio...
		} else {
			header('location:../login.php');
		}



	}

	mysqli_close($conexao);

?>

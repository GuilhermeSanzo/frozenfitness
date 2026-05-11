<?php

  require_once('cms/php/geral.php');

  function Inserir($nome, $sobre_nome, $email, $senha, $sexo, $data_nascimento, $cpf, $telefone, $peso, $altura, $tipo_dieta_id) {

    $conexao = connect();
    $sql = "insert into usuario(nome, sobre_nome, email, senha, sexo, data_nascimento, cpf, telefone, peso, altura, tipo_dieta_id, tipo_usuario_id) values ('".$nome."', '".$sobre_nome."','".$email."', '".$senha."', ".$sexo.", '".$data_nascimento."', '".$cpf."', '".$telefone."', ".$peso.", ".$altura.", ".$tipo_dieta_id.", 1)";

    $insert = mysqli_query($conexao,$sql);
	mysqli_close($conexao);

    // echo("<script>alert('Funcionou!');</script>");

		// header("location:home.php");

  }

?>

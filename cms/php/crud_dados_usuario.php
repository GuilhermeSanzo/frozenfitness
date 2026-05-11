<?php

  require_once('cms/php/geral.php');

  // Função para listar os dados de usuário
  function Buscar($usuario_id) {
    $conexao = connect();
		$sql = "select nome, sobre_nome as 'sobrenome', sexo, data_nascimento, cpf, telefone, peso, altura, tipo_dieta_id
      from usuario where usuario_id = ".$usuario_id;
		$select = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
		$array = mysqli_fetch_array($select);
		return $array;
  }

  function Editar($usuario_id, $nome, $sobrenome, $sexo, $data_nascimento, $cpf, $telefone, $peso, $altura, $tipo_dieta_id, $imagem, $caminho_imagem) {
    $conexao = connect();

		if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_imagem)){
			$sql = "update usuario set nome = '".$nome."', sobre_nome = '".$sobrenome."', sexo = ".$sexo.",
      data_nascimento = '".$data_nascimento."', cpf = '".$cpf."', telefone = '".$telefone."', peso = ".$peso.", altura = ".$altura.",
      tipo_dieta_id = ".$tipo_dieta_id.", caminho_imagem = '".$caminho_imagem."' where usuario_id = ".$usuario_id;

      $_SESSION['imagem'] = $caminho_imagem;
      $_SESSION['nome'] = $nome;
    } else {
      $sql = "update usuario set nome = '".$nome."', sobre_nome = '".$sobrenome."', sexo = ".$sexo.",
      data_nascimento = '".$data_nascimento."', cpf = '".$cpf."', telefone = '".$telefone."', peso = ".$peso.", altura = ".$altura.",
      tipo_dieta_id = ".$tipo_dieta_id." where usuario_id = ".$usuario_id;
      $_SESSION['nome'] = $nome;
    }

    $query = mysqli_query($conexao, $sql);

    // echo "
    // <script>
    //   $(document).ready(function(){
    //     bootbox.alert('Informações editadas com sucesso!', function() {
    //       $(location).attr('href', 'dados_usuario.php');
    //     });
    //   });
    // </script>";

    header("location:dados_usuario.php");

    mysqli_close($conexao);
  }


 ?>

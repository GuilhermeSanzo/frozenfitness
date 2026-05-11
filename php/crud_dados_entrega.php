<?php

  require_once('cms/php/geral.php');

  // Função para listar o endereço
  function Listar() {
    $conexao = connect();

    $logradouro = null;
    $nome = null;
    $numero = null;
    $cep = null;
    $bairro = null;
    $cidade = null;
    $estado = null;

    $data_entrega = date('d-m-Y', strtotime('+3 days'));

    echo '
      <form action="php/add_dados_entrega.php" method="post">
        <table>
          <thead>
            <tr>
              <th colspan="2">Confirme a data de entrega</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Data de entrega: </td>
              <td>
                <input type="text" id="data_entrega" name="data_entrega" value="'.$data_entrega.'" required>
                <span class="tooltip">Data Inválida</span>
                <span class="tooltip_valid">Data Válida</span>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">
                <p>Obs: A data de entrega do pedido só é válida após 3 dias em que o pedido foi feito.</p>
              </td>
            </tr>
          </tbody>
          <thead>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <th colspan="2">Confirme o Endereço</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>CEP: </td>
              <td><input id="txtCep" type="text" name="cep" value="'.$cep.'" required></td>
            </tr>
            <tr>
              <td>Logradouro: </td>
              <td>
                <select id="cboLogradouro" name="logradouro" required>
                  <option value="" disabled selected>Escolha um logradouro</option>
                  <option value="Rua">Rua</option>
                  <option value="Avenida">Avenida</option>
                  <option value="Alameda">Alameda</option>
                  <option value="Estrada">Estrada</option>
                  <option value="Rodovia">Rodovia</option>
                  <option value="Quilômetro">Quilômetro</option>
                  <option value="Outro">Outro</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Nome: </td>
              <td><input id="txtNome" type="text" name="nome" value="'.$nome.'" required></td>
            </tr>
            <tr>
              <td>Número: </td>
              <td><input id="txtNumero" type="number" name="numero" value="'.$numero.'" required></td>
            </tr>
            <tr>
              <td>Bairro: </td>
              <td><input id="txtBairro" type="text" name="bairro" value="'.$bairro.'" required></td>
            </tr>
            <tr>
              <td>Cidade: </td>
              <td><input id="txtCidade" type="text" name="cidade" value="'.$cidade.'" required></td>
            </tr>
            <tr>
              <td>Estado: </td>
              <td><input id="txtEstado" type="text" name="estado" value="'.$estado.'" required></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" name="inserir" value="Confirmar"></td>
            </tr>
          </tbody>
        </table>
      </form>
    ';


    mysqli_close($conexao);
  }

  // Função para listar um endereço já cadastrado
  function ListarEspecifico($usuario_id) {
    $conexao = connect();

    $logradouro = null;
    $nome = null;
    $numero = null;
    $cep = null;
    $bairro = null;
    $cidade = null;
    $estado = null;

    $sql_usuario = "select * from usuario where usuario_id = ".$usuario_id;
    $query_usuario = mysqli_query($conexao, $sql_usuario);
    $array_usuario = mysqli_fetch_array($query_usuario);
    $endereco_id = $array_usuario['endereco_id'];

    $select = "select e.endereco_id, e.logradouro, e.nome, e.numero, e.cep, e.bairro, e.cidade, e.estado
              from endereco as e
              where endereco_id = ". $endereco_id;
    $query = mysqli_query($conexao, $select);
    $array = mysqli_fetch_array($query);

    $logradouro = $array['logradouro'];
    $nome = $array['nome'];
    $numero = $array['numero'];
    $cep = $array['cep'];
    $bairro = $array['bairro'];
    $cidade = $array['cidade'];
    $estado = $array['estado'];

    $data_entrega = date('d-m-Y', strtotime('+3 days'));

    echo '
      <form action="php/add_dados_entrega.php" method="post">
        <table>
          <thead>
            <tr>
              <th colspan="2">Confirme a data de entrega</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Data de entrega: </td>
              <td>
                <input type="text" id="data_entrega" name="data_entrega" value="'.$data_entrega.'" required>
                <span class="tooltip">Data Inválida</span>
                <span class="tooltip_valid">Data Válida</span>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">
                <p>Obs: A data de entrega do pedido só é válida após 3 dias em que o pedido foi feito.</p>
              </td>
            </tr>
          </tbody>
          <thead>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <th colspan="2">Confirme o Endereço</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>CEP: </td>
              <td><input id="txtCep" type="text" name="cep" value="'.$cep.'" required></td>
            </tr>
            <tr>
              <td>Logradouro: </td>
              <td>
                <select id="cboLogradouro" name="logradouro" required>
                  <option value="'.$logradouro.'">'.$logradouro.'</option>
                  <option value="Rua">Rua</option>
                  <option value="Avenida">Avenida</option>
                  <option value="Alameda">Alameda</option>
                  <option value="Estrada">Estrada</option>
                  <option value="Rodovia">Rodovia</option>
                  <option value="Quilômetro">Quilômetro</option>
                  <option value="Outro">Outro</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Nome: </td>
              <td><input id="txtNome" type="text" name="nome" value="'.$nome.'" required></td>
            </tr>
            <tr>
              <td>Número: </td>
              <td><input id="txtNumero" type="number" name="numero" value="'.$numero.'" required></td>
            </tr>
            <tr>
              <td>Bairro: </td>
              <td><input id="txtBairro" type="text" name="bairro" value="'.$bairro.'" required></td>
            </tr>
            <tr>
              <td>Cidade: </td>
              <td><input id="txtCidade" type="text" name="cidade" value="'.$cidade.'" required></td>
            </tr>
            <tr>
              <td>Estado: </td>
              <td><input id="txtEstado" type="text" name="estado" value="'.$estado.'" required></td>
            </tr>
            <tr>
              <td></td>
              <td><input id="submit" type="submit" name="atualizar" value="Confirmar"></td>
            </tr>
          </tbody>
        </table>
      </form>
    ';


    mysqli_close($conexao);
  }

  // Função para inserir o endereço
  function Inserir($usuario_id, $endereco_id, $logradouro, $nome, $numero, $cep, $bairro, $cidade, $estado) {
    $conexao = connect();

    $sql_usuario = "update usuario set endereco_id = ".$endereco_id." where usuario_id = ".$usuario_id;
    $query_usuario = mysqli_query($conexao, $sql_usuario);

    $sql_endereco = "insert endereco set logradouro = '".$logradouro."', nome = '".$nome."', numero = ".$numero.", cep = '".$cep."', bairro = ".$bairro.", cidade_id = ".$cidade.", estado_id = ".$estado." where endereco_id = ".$endereco_id;
    $query_endereco = mysqli_query($conexao, $sql_endereco);


    mysqli_close($conexao);
  }

  // Função para atualizar o endereço
  function Atualizar($usuario_id, $endereco_id, $logradouro, $nome, $numero, $cep, $bairro, $cidade, $estado) {
    $conexao = connect();

    $sql_usuario = "update usuario set endereco_id = ".$endereco_id." where usuario_id = ".$usuario_id;
    $query_usuario = mysqli_query($conexao, $sql_usuario);

    $sql_endereco = "update endereco set logradouro = '".$logradouro."', nome = '".$nome."', numero = ".$numero.", cep = '".$cep."', bairro = ".$bairro.", cidade_id = ".$cidade.", estado_id = ".$estado." where endereco_id = ".$endereco_id;
    $query_endereco = mysqli_query($conexao, $sql_endereco);

    mysqli_close($conexao);
  }


?>

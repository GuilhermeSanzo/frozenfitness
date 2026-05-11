<?php

  require_once('cms/php/geral.php');

  // Função para listar opções de pagamento
  function Listar() {
    $conexao = connect();

    $nome_usuario = null;
    $sobrenome_usuario = null;

    $sql = "select u.nome as 'nome_usuario', u.sobre_nome as 'sobrenome_usuario', u.*, e.* from usuario as u
    inner join endereco as e on(u.endereco_id = e.endereco_id)
    where usuario_id =".$_SESSION['usuario_id'];
    $select = mysqli_query($conexao, $sql);
    $array = mysqli_fetch_array($select);

    $nome_usuario = $array['nome_usuario'];
    $sobrenome_usuario = $array['sobrenome_usuario'];

    $data = date('d-m-Y');

    $total = 0;

    if(!empty($_SESSION['carrinho']['prato'])) {
      foreach($_SESSION['carrinho']['prato'] as $prato_id => $qtde){
        $sql = "select 
                  p.prato_id, 
                  p.nome,
                  p.valor_unitario,
                  p.caminho_imagem,
                  p.descricao,
                  p.tipo_dieta_id,
                  sum(i.kcal_por_100g) as kcal_por_100g, 
                  sum(pi.qtd) as peso, 
                  round((sum(pi.qtd)/100)*sum(i.kcal_por_100g)) as kcal_prato, 
                  count(pp.prato_id) as esta_promocao,
                  round(p.valor_unitario - p.valor_unitario * (pr.porcentagem_desc / 100),2) as valor_desconto,
                  '' as tipo_dieta,
                  '' as qtd_dias,
                          '' as cor,
                  'prato' as tipo
                  from prato as p 
                  inner join rel_prato_ingrediente as pi 
                  on pi.prato_id = p.prato_id 
                  inner join ingrediente as i 
                  on pi.ingrediente_id = i.ingrediente_id 
                  left join rel_prato_promocao as pp
                  on pp.prato_id = p.prato_id
                  left join promocao as pr
                  on pr.promocao_id = pp.promocao_id 
                  where p.prato_id = $prato_id
                  group by p.prato_id 
                  order by kcal_prato";
          $query = mysqli_query($conexao, $sql);
          while($listar = mysqli_fetch_array($query)) {

          $nome = $listar["nome"];
          if($listar['esta_promocao'] > 0){
            $preco = $listar["valor_desconto"];
          }else{
            $preco = $listar["valor_unitario"];
          }
        $subtotal = $preco * $qtde;
        $total += $subtotal;
        }
      }
    }

    if(!empty($_SESSION['carrinho']['dieta'])) {
      foreach($_SESSION['carrinho']['dieta'] as $dieta_id => $qtde){
        $sql = "select 
                  d.dieta_id,
                  d.nome,
                  sum(p.valor_unitario) as valor_unitario,
                  '' as caminho_imagem,
                  d.descricao,
                  d.tipo_dieta_id,
                  sum(i.kcal_por_100g) as kcal_por_100g,
                  sum(pi.qtd) as peso,
                  (select sum(kcal_dieta) from (select 
                  round((sum(pi.qtd)/100)*sum(i.kcal_por_100g)) as 'kcal_dieta'
                  from dieta as d
                  inner join rel_dieta_prato as dp
                  on (dp.dieta_id = d.dieta_id)
                  inner join prato as p
                  on (dp.prato_id = p.prato_id)
                  inner join rel_prato_ingrediente as pi
                  on (pi.prato_id = p.prato_id)
                  inner join ingrediente as i
                  on (i.ingrediente_id = pi.ingrediente_id)
                  group by p.prato_id) as a) as kcal_dieta,
                  '0' as esta_promocao,
                  NULL as valor_desconto,
                  td.nome as tipo_dieta,
                  count(distinct dp.dia) as qtd_dias,
                          td.cor as cor,
                  'dieta' as tipo
                  from dieta as d
                  inner join rel_dieta_prato as dp
                  on (dp.dieta_id = d.dieta_id)
                  inner join prato as p
                  on (dp.prato_id = p.prato_id)
                  inner join rel_prato_ingrediente as pi
                  on (pi.prato_id = p.prato_id)
                  inner join ingrediente as i
                  on (i.ingrediente_id = pi.ingrediente_id)
                  inner join tipo_dieta as td
                  on (td.tipo_dieta_id = d.tipo_dieta_id) 
                  where d.dieta_id = $dieta_id
                  group by dieta_id";
        $query = mysqli_query($conexao, $sql);
        while($listar = mysqli_fetch_array($query)) {

        $preco = $listar["valor_unitario"];
        $subtotal = $preco * $qtde;
        $total += $subtotal;
        }
      }
    }

    $total = $total + 10.00;
      echo'
      <form method="post" action="php/boleto.php" target="_blank">
        <table>
          <thead>
            <tr>
              <th colspan="2">Confirmar Pagamento</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Nome Completo: </td>
              <td><input type="text" name="nome" value="'.$nome_usuario.' '.$sobrenome_usuario.'" disabled></td>
            </tr>
            <tr>
              <td>Forma de pagamento: </td>
              <td>
                <select name="forma_pagamento">
                  <option>Boleto</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Boleto emitido em: </td>
              <td><input type="text" value="'.date('d/m/Y').'" disabled></td>
            </tr>
            <tr>
              <td>Data de Pagamento: </td>
              <td>
                <select name="data_vencimento">
                  <option>'.date('d/m/Y', strtotime('+1 days')).'</option>
                  <option>'.date('d/m/Y', strtotime('+7 days')).'</option>
                  <option>'.date('d/m/Y', strtotime('+14 days')).'</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Preço Total: </td>
              <td><input name="preco_total" type="text" value="R$ '.number_format($total, 2, ',', '.').'" readonly="readonly"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="gerar" value="Gerar Boleto"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><p>Obs: Tenha certeza de que salvou ou imprimiu a página ao fechar a guia do boleto</p></td>
            </tr>
          </tbody>
        </table>
      </form>
      ';

    mysqli_close($conexao);
  }

?>

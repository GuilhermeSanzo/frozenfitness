<?php

  require_once('cms/php/geral.php');

  // Função para listar
  function Listar() {

    $conexao = connect();

    // Instaciando as variáveis
    $nome = null;
    $preco = null;
    $imagem = null;
    $subtotal = null;
    $frete = 10;
    $total = null;

    $total += $frete;

    echo'

      ';


    // Verificando se não há produto no carrinho
    if (count($_SESSION['carrinho']) == 0) {
      echo'
      <div class="lista_carrinho">
        <h1 class="titulo_sem_produto">Não há produtos no carrinho!</h1>
        <span class="sad_face"></span>
      </div>
      ';
    // Caso tenha produtos...
    } else {

      echo'
      <form id="form_compra" action="php/add_carrinho.php" method="post">
      <div class="lista_carrinho">
        <table class="tbl_lista_carrinho">
          <thead>
            <tr>
              <th>PRODUTO</th>
              <th>NOME</th>
              <th>QUANTIDADE</th>
              <th>PREÇO</th>
              <th>SUBTOTAL</th>
              <th>EXCLUIR</th>
            </tr>
          </thead>
          <tbody>
      ';

      // Prato ID
      if (!empty($_SESSION['carrinho']['prato'])) {
        foreach($_SESSION['carrinho']['prato'] as $prato_id => $qtde){
          // $sql = "select * from prato where prato_id = $prato_id";

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
          $imagem = $listar["caminho_imagem"];
          $subtotal = $preco * $qtde;
          $total += $subtotal;

          echo'
            <tr class="tr_produto">
              <td><img src="cms/cms/'.$imagem.'" width="100px"> </td>
              <td class="td_nome">'.$nome.'</td>
              <td><input id="input_number" prato_id = "'.$prato_id.'" class="input_number" name="produto_prato['.$prato_id.']" value="'.$qtde.'" type="number" min="1" max="100"></td>
              <td>R$ '.number_format($preco, 2, ',', '.').'</td>
              <td>R$ <span class="subtotal" id="prato'.$prato_id.'">'.number_format($subtotal, 2, ',', '.').'</span></td>
              <td><a href="php/add_carrinho.php?action=remove&prato_id='.$prato_id.'"><span class="remove_item"></span</a></td>
            </tr>
          ';

          }
        }
      }

      // Dieta ID
      if (!empty($_SESSION['carrinho']['dieta'])){
        foreach($_SESSION['carrinho']['dieta'] as $dieta_id => $qtde){

          $sql = "select 
                  d.dieta_id,
                  d.nome,
                  sum(distinct p.valor_unitario) as valor_unitario,
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

          $nome = $listar["nome"];
          $preco = $listar["valor_unitario"];
          $subtotal = $preco * $qtde;
          $total += $subtotal;

          echo'
          <tr>
              <td>
                <div class="cx_produto">
                  <div class="box_dieta" style="background-color:'.$listar['cor'].'">
                    <div class="box_dias_dieta">
                      Quantidade de dias:<br>
                      <span class="dias_dieta">'.$listar['qtd_dias'].' Dia(s)</span>
                    </div>
                    <div class="box_tipo_dieta">
                      '.$listar['tipo_dieta'].'
                    </div>
                  </div>
                </div>
              </td>
              <td>'.$nome.'</td>
              <td><input id="input_number" dieta_id = "'.$dieta_id.'" class="input_number" name="produto_dieta['.$dieta_id.']" value="'.$qtde.'" type="number" min="1" max="100"></td>
              <td>R$ '.number_format($preco, 2, ',', '.').'</td>
              <td>R$ <span class="subtotal" id="dieta'.$dieta_id.'">'.number_format($subtotal, 2, ',', '.').'</span></td>
              <td><a href="php/add_carrinho.php?action=remove&dieta_id='.$dieta_id.'"><span class="remove_item"></span</a></td>
            </tr>
          ';

          }
        }
      }

      echo'
      <tr class="tr_menor">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class="td_except">FRETE</td>
        <td class="td_except">R$ '.number_format($frete, 2, ',', '.').'</td>
      </tr>
      ';

      echo'
      <tr class="tr_menor">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class="td_except">TOTAL</td>
        <td class="td_except">R$ <span id="pedido_total">'.number_format($total, 2, ',', '.').'</span></td>
      </tr>
      ';

      echo'

        <tr class="last_line">

          <td colspan="2">
            <input type="submit" name="atualizar" value="ATUALIZAR" class="atualizar_carrinho">
          </td>
          <td colspan="2" id="except_limpar">
            <input type="submit" name="limpar" value="LIMPAR" class="limpar_carrinho">
          </td>
          <td colspan="2">
            <input type="submit" name="finalizar" value="FINALIZAR PEDIDO" class="finalizar_carrinho">
          </td>

        </tr>

      ';



    }

    echo'
          </tbody>
        </table>
      </div>
      </form>
    ';

    mysqli_close($conexao);

    }



?>

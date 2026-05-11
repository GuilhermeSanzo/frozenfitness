$(document).ready(function(){
	$(document).on('keyup','.input_number', function(){

		var qtde, prato_id, dieta_id, valor_unitario, subtotal, total = 0;

		qtde = $(this).val();
		prato_id = $(this).attr('prato_id');
		dieta_id = $(this).attr('dieta_id');


		if(prato_id!=undefined){
			$.ajax({
				url:'json/calcular_item_pedido.php?prato_id='+prato_id,
				dataType:'json',
				success:function(data){
					valor_unitario = data.valor_unitario;
					subtotal = qtde * valor_unitario;

					// Convertendo o subtotal para tipo numeral de dinheiro
					subtotal_money = numeral(subtotal).format('0.00');
					subtotal_money = subtotal_money.replace('.', ',');

					$('#prato'+prato_id).html(subtotal_money);

					calcularTotal();
				}
			});
		}else{
			$.ajax({
				url:'json/calcular_item_pedido.php?dieta_id='+dieta_id,
				dataType:'json',
				success:function(data){
					valor_unitario = data.valor_unitario;
					subtotal = qtde * valor_unitario;

					// Convertendo o subtotal para tipo numeral de dinheiro
					subtotal_money = numeral(subtotal).format('0.00');
					subtotal_money = subtotal_money.replace('.', ',');

					$('#dieta'+dieta_id).html(subtotal_money);

					calcularTotal();
				}
			});
		}
	});

});

// Calculando o valor total
function calcularTotal() {

	var qtde_subtotais = $('.subtotal').size();
	var total = 0;

	for(var i = 0; i < qtde_subtotais; i++){
		var este_valor = $('.subtotal:eq('+i+')').text();
		este_valor = parseFloat(este_valor.replace(',', '.'));

		total += este_valor;
	}

	// Convertendo o total para tipo numeral de dinheiro
	total_money = numeral(total+10).format('0.00');
	total_money = total_money.replace('.', ',');

	$('#pedido_total').html(total_money);

}

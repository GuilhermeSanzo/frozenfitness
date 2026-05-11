
//Quando o select de promoções é alterado
$(document).on('change',".select_promocao",function (e) {

	var prato_id;
	var nome_prato;
	var nome_promocao;
	var promocao_id;
	var id_deste_select = $(this).attr("id");
	var numero_do_id = id_deste_select.substr(id_deste_select.lastIndexOf("o")+1, id_deste_select.length);

	prato_id = $(this).attr("prato_id");
	nome_prato = $(this).attr("nome_prato");
	promocao_id = $(this).val();
	nome_promocao = $("#"+id_deste_select+" option:selected").text();

	if(promocao_id != ""){
		$(".fundo_preto_transparente").fadeIn("fast");
		$("#mensagem_aplicar").fadeIn("fast");
		$("#nome_prato1").html(nome_prato);
		$("#nome_promocao1").html(nome_promocao);
	}

	$(document).on("click","#btn_resposta_sim",function(){
		$.ajax({
		  type: "GET",
		  url: 'php/crud_rel_prato_promocao.php?inserir_promocao=0&prato_id='+prato_id+'&promocao_id='+promocao_id,
		  dataType: "json",
		  success: function(data){
		  	alert("Promoção aplicada com sucesso!");
		  	$(".fundo_preto_transparente").fadeOut("fast");
			$(".esp_mensagem").fadeOut("fast");
			window.location.replace("cadastro_rel_prato_promocao.php");
		  }
		});
	});

	$(document).on("click","#btn_resposta_nao",function(){
		$(".fundo_preto_transparente").fadeOut("fast");
		$(".esp_mensagem").fadeOut("fast");
	});
});

//Quando o remover promoção é selecionado
$(document).on('click',".remover_promocao",function (e) {

	var prato_id;
	var nome_prato;
	var nome_promocao;
	var promocao_id;

	prato_id = $(this).attr("prato_id");
	nome_prato = $(this).attr("nome_prato");
	promocao_id = $(this).attr("promocao_id");
	nome_promocao = $(this).attr("nome_promocao");

	if(nome_promocao!=""){

		$(".fundo_preto_transparente").fadeIn("fast");
		$("#mensagem_remover").fadeIn("fast");
		$("#nome_prato2").html(nome_prato);
		$("#nome_promocao2").html(nome_promocao);

		$(document).on("click","#btn_resposta_sim1",function(){
		$.ajax({
		  type: "GET",
		  url: 'php/crud_rel_prato_promocao.php?remover_promocao=0&prato_id='+prato_id+'&promocao_id='+promocao_id,
		  dataType: "json",
		  success: function(data){
		  	alert("Promoção removida com sucesso!");
		  	$(".fundo_preto_transparente").fadeOut("fast");
			$(".esp_mensagem").fadeOut("fast");
			window.location.replace("cadastro_rel_prato_promocao.php");
		  }
			});
		});

		$(document).on("click","#btn_resposta_nao1",function(){
			$(".fundo_preto_transparente").fadeOut("fast");
			$(".esp_mensagem").fadeOut("fast");
		});
	}else{
		alert("Este produto não possui uma promoção");
	}
	

	
});



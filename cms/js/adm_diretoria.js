
$(document).ready(function(){
	carregarAprovacoes();
	carregarAprovados();
});

//Trocas de tela
$(document).on("click",".botao_diretoria", function(){
	var id_do_botao = $(this).attr("id");
	var id_icon = $(this).children().eq(0).attr("id");
	var id_text = $(this).children().eq(1).attr("id");

	if(id_do_botao == "btn_estatisticas"){
		$("#aprovacoes").css("display","none");
		$("#estatisticas").fadeIn("fast");

		//Mudando as carácterísticas do botão Estatísticas
		$("#"+id_do_botao).css('background-color','#4b9260');
		$("#"+id_do_botao).css('color','#ffffff');
		$("#"+id_icon).css('background-image','url(img/graph_icon.svg)');
		$("#"+id_do_botao).attr("class","botao_diretoria destaque");
		$("#"+id_text).css('color','#ffffff');

		//Removendo as carácterísticasdo botão Estatísticas
		$("#btn_aprovacoes").attr("class","botao_diretoria");
		$("#btn_aprovacoes").css("background-color","transparent");
		$("#icon_aprovacoes").css('background-image','url(img/graph_icon_preto.svg)');
		$("#texto_aprovacoes").css('color','#000000');
	}else if(id_do_botao == "btn_aprovacoes"){
		$("#estatisticas").css("display","none");
		$("#aprovacoes").fadeIn("fast");


		//Mudando as carácterísticas do botão Aprovações
		$("#"+id_do_botao).css('background-color','#4b9260');
		$("#"+id_do_botao).css('color','#ffffff');
		$("#"+id_icon).css('background-image','url(img/graph_icon.svg)');
		$("#"+id_do_botao).attr("class","botao_diretoria destaque");
		$("#"+id_text).css('color','#ffffff');


		//Removendo as carácterísticasdo botão Estatísticas
		$("#btn_estatisticas").attr("class","botao_diretoria");
		$("#btn_estatisticas").css("background-color","transparent");
		$("#icon_estatisticas").css('background-image','url(img/graph_icon_preto.svg)');
		$("#texto_estatisticas").css('color','#000000');
	}
});



//Efeito Quando o mouse está por cima
$(document).ready(function(){
	$(".botao_diretoria").on( "mouseenter", function(){

		var this_class = $(this).attr("class");
		var id_icon = $(this).children().eq(0).attr("id");
		var id_text = $(this).children().eq(1).attr("id");

		if(this_class.search("destaque")<0){
			$(this).css({
			    'background-color': '#4b9260',
			    'color' : '#ffffff',
			    'transition': 'background 500ms ease'
			});

			$("#"+id_icon).css({
				'background-image':'url(img/graph_icon.svg)',
				'transition': 'background 200ms ease'
			});

			$("#"+id_text).css({
				'color':'#ffffff',
				'transition': 'background 200ms ease'
			});
		}
	});

	$(".botao_diretoria").on( "mouseleave", function(){

		var this_class = $(this).attr("class");
		var id_icon = $(this).children().eq(0).attr("id");
		var id_text = $(this).children().eq(1).attr("id");

		if(this_class.search("destaque")<0){
			$(this).css({
			    'background-color': 'transparent',
			    'transition': 'background 500ms ease'
			});

			$("#"+id_icon).css({
				'background-image':'url(img/graph_icon_preto.svg)',
				'transition': 'background 200ms ease'
			});

			$("#"+id_text).css({
				'color':'#000000',
				'transition': 'background 200ms ease'
			});
		}
	});
});

//Carregar bloco de produtos para aprovar
function carregarAprovacoes(){
	$.ajax({
		url:"json/aprovacoes.php?listar_pratos_p_aprovar=0",
		dataType:"json",
		success:function(data){

			var HTMLitensaprovacao = "";

			for(var i=0; i<data.length; i++){
				if(data[i].tipo == "prato"){
					HTMLitensaprovacao = HTMLitensaprovacao + '<div class="box_item_aprovacao">'+ 
							    '<div class="box_img_item" style="background-image:url('+data[i].caminho_imagem+')">'+
							    '</div>'+
							    '<div class="box_titulo_item">'+
							    	data[i].nome+
							    '</div>'+
							    '<div class="box_preco_item">'+
							    	data[i].valor_unitario+
							    '</div>'+
							    '<div class="box_botoes_aprovacao">'+
							    	'<div class="pergunta">Aprovar?</div>'+
							    	'<div class="resposta">'+
							    		'<div class="btn_resposta resposta_sim" id="'+data[i].id+'" tipo="'+data[i].tipo+'" resposta="2">Sim</div>'+
							    		'<div class="btn_resposta resposta_nao" id="'+data[i].id+'" tipo="'+data[i].tipo+'" resposta="3">Não</div>'+
							    		'<div style="clear:both"></div>'+
							    	'</div>'+
							    	'<div style="clear:both"></div>'+
							    '</div>'+
							    '<div style="clear:both"></div>'+
							  '</div>';
				}else if(data[i].tipo == "dieta"){
					HTMLitensaprovacao = HTMLitensaprovacao + '<div class="box_item_aprovacao">'+ 
							    '<div class="box_img_dieta">'+
							    	'<div class="box_dias_dieta">'+
								  			'Quantidade de dias:<br>'+
								   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
								  			'</div>'+
								      	'<div class="box_tipo_dieta">'+
								          data[i].tipo_dieta+
								      '</div>'+
							    '</div>'+
							    '<div class="box_titulo_item">'+
							    	data[i].nome+
							    '</div>'+
							    '<div class="box_preco_item">'+
							    	data[i].valor_unitario+
							    '</div>'+
							    '<div class="box_botoes_aprovacao">'+
							    	'<div class="pergunta">Aprovar?</div>'+
							    	'<div class="resposta">'+
							    		'<div class="btn_resposta resposta_sim" id="'+data[i].id+'" tipo="'+data[i].tipo+'" resposta="2">Sim</div>'+
							    		'<div class="btn_resposta resposta_nao" id="'+data[i].id+'" tipo="'+data[i].tipo+'" resposta="3">Não</div>'+
							    		'<div style="clear:both"></div>'+
							    	'</div>'+
							    	'<div style="clear:both"></div>'+
							    '</div>'+
							    '<div style="clear:both"></div>'+
							  '</div>';;
				}
			}

			$("#itens_para_aprovar").html(HTMLitensaprovacao);
			
		}
	});
}

//Carregar bloco de aprovados
function carregarAprovados(){
	$.ajax({
		url:"json/aprovacoes.php?listar_pratos_aprovados=0",
		dataType:"json",
		success:function(data){

			var HTMLitensaprovacao = "";

			for(var i=0; i<data.length; i++){
				if(data[i].tipo == "prato"){
					var aprovacao
					if(data[i].aprovacao_id == 2){
						aprovacao = 'aprovado';
					}else{
						aprovacao = 'nao_aprovado';
					}

					HTMLitensaprovacao = HTMLitensaprovacao + '<div class="box_item_aprovacao">'+ 
							    '<div class="box_img_item" style="background-image:url('+data[i].caminho_imagem+')">'+
							    '</div>'+
							    '<div class="box_titulo_item">'+
							    	data[i].nome+
							    '</div>'+
							    '<div class="box_preco_item">'+
							    	data[i].valor_unitario+
							    '</div>'+
							    '<div class="box_botoes_aprovacao">'+
							    	'<div class="pergunta">Status:</div>'+
							    	'<div class="resposta '+aprovacao+'">'+
							    		data[i].aprovacao+
							    	'</div>'+
							    	'<div style="clear:both"></div>'+
							    '</div>'+
							    '<div style="clear:both"></div>'+
							  '</div>';
				}else if(data[i].tipo == "dieta"){
					HTMLitensaprovacao = HTMLitensaprovacao + '<div class="box_item_aprovacao">'+ 
							    '<div class="box_img_dieta">'+
							    	'<div class="box_dias_dieta">'+
								  			'Quantidade de dias:<br>'+
								   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
								  			'</div>'+
								      	'<div class="box_tipo_dieta">'+
								          data[i].tipo_dieta+
								      '</div>'+
							    '</div>'+
							    '<div class="box_titulo_item">'+
							    	data[i].nome+
							    '</div>'+
							    '<div class="box_preco_item">'+
							    	data[i].valor_unitario+
							    '</div>'+
							    '<div class="box_botoes_aprovacao">'+
							    	'<div class="pergunta">Status:</div>'+
							    	'<div class="resposta '+aprovacao+'">'+
							    		data[i].aprovacao+
							    	'</div>'+
							    	'<div style="clear:both"></div>'+
							    '</div>'+
							    '<div style="clear:both"></div>'+
							  '</div>';
				}
			}

			$("#itens_aprovados").html(HTMLitensaprovacao);
			
		}
	});
}




$(document).on('click','.btn_resposta',function(){
	var id = $(this).attr("id");
	var tipo = $(this).attr("tipo");
	var resposta = $(this).attr("resposta");

	aprovar_produto(id,tipo,resposta);
})

function aprovar_produto(id,tipo,resposta) {
	$.ajax({
		url:'json/aprovacoes.php?avaliar_produto=0&id='+id+'&tipo='+tipo+'&resposta='+resposta,
		dataType:'json',
		success:function(data){
			if(data.resultado == '1'){
				alert("Produto avaliado com sucesso!");
				carregarAprovacoes();
				carregarAprovados();
			}
		}
	});
}



// Gráfico de barras

// Add values to the values array and see what happens :)

$(document).ready(function(){
	var values = [5,4,3,2,1];
	var pratos = ["Banana","Pera","Torta","Limão","Açúcar"];

	drawChart(values,"#chart",10,pratos) // You can adjust the margin between each bar by changing 10 to whatever you like

	function drawChart(data,selector,padding,pratos){
	  var max = Math.max.apply(Math, data);
		var chart = document.querySelector(selector);
		var barwidth = ((chart.offsetWidth-(values.length-1)*padding-(data.length)*10)/data.length);
		var sum = data.reduce(function(pv, cv) { return pv + cv; }, 0);
		var left = 0;
		for (var i in data){
		  var newbar = document.createElement('div');
		  newbar.setAttribute("class", "bar");
		  newbar.setAttribute("id","prato"+i);
		  newbar.style.width=barwidth+"px";
		  newbar.style.height=((data[i]/max)*100)+"%";
		  newbar.style.left=left+"px";
		  chart.appendChild(newbar);

		   $("#prato"+i).html("<div class='product_name'><b>"+pratos[i]+"</b><br>"+data[i]+" vendas</>");

		  left += (barwidth+padding+10);
		}
	}
});

$(document).ready(function(){


	var values = [];
	var pratos = [];

	for(i=0; i<=4;i++){
		values.push($("#view_produto"+i).text());
		pratos.push($("#nome_view_produto"+i).text());
	}

	drawChart(values,"#chart2",10,pratos) // You can adjust the margin between each bar by changing 10 to whatever you like

	function drawChart(data,selector,padding,pratos){
	  var max = Math.max.apply(Math, data);
		var chart = document.querySelector(selector);
		var barwidth = ((chart.offsetWidth-(values.length-1)*padding-(data.length)*10)/data.length);
		var sum = data.reduce(function(pv, cv) { return pv + cv; }, 0);
		var left = 0;
		for (var i in data){
		  var newbar = document.createElement('div');
		  newbar.setAttribute("class", "bar2");
		  newbar.setAttribute("id","prato2"+i);
		  newbar.style.width=barwidth+"px";
		  newbar.style.height=((data[i]/max)*100)+"%";
		  newbar.style.left=left+"px";
		  chart.appendChild(newbar);

		  $("#prato2"+i).html("<div class='product_name'><b>"+pratos[i]+"</b><br>"+data[i]+" visualizações</>");

		  left += (barwidth+padding+10);
		}
	}
});

	



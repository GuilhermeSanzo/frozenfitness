/*

	JAVASCRIPT HOME

*/

$(document).ready(function(){
	// alinharMenuLateral();

	if ($(window).width() > 500) {
		carregarHipertrofia();
		carregarEmagrecimento();
	} else {
		carregarHipertrofiaResponsivo();
		carregarEmagrecimentoResponsivo();
	}
	
	


});

function alinharMenuLateral(){

	var altura_conteudo;

	altura_conteudo = $(".conteudo").css("height");
	altura_conteudo = altura_conteudo.substr(0,altura_conteudo.lastIndexOf("p"));

	$(".box_menu_lateral").css("height",altura_conteudo);
}

// Desktop
function carregarHipertrofia(){

	$.ajax({
	  type: "GET",
	  url: 'json/listar_pratos.php?tipo_dieta_id=2',
	  dataType: "json",
	  success: function(data){

	  	var HTMLpratos = "";



	  	//Listando os pratos...
	  	for(var i=0;i<data.length;i++){

	  		var HTMLpratos;

	  		var prato_id = data[i].prato_id;
			var nome = data[i].nome;
			var valor_unitario = data[i].valor_unitario;
			var valor_desconto = data[i].valor_desconto;
			var caminho_imagem = data[i].caminho_imagem;
			var descricao = data[i].descricao;
			var tipo_dieta_id = data[i].tipo_dieta_id;
			var kcal_por_100g = data[i].kcal_por_100g;
			var peso = data[i].peso;
			var kcal_prato = data[i].kcal_prato;
			var esta_promocao = data[i].esta_promocao;

			//Formatando Título
			if(nome.length > 20){
				nome = nome.substr(0,20)+"...";
			}

			//Formatando descrição
			if(descricao.length > 45){
				descricao = descricao.substr(0,53)+"...";
			}

			//Formatando preços
			valor_unitario = "R$ "+valor_unitario.replace(".",",");
			if(valor_desconto != ""){
				valor_desconto = "R$ "+valor_desconto.replace(".",",");
			}

			kcal_prato = kcal_prato+"kcal";


	  		//Mostrar os 3 primeiros pratos
	  		if(i<=2){
	  			//Se o contador estiver entre 0 e 2 e os pratos estiverem em promoção, mostrar a mensagem promoção
	  			if(data[i].esta_promocao > 0){
	  				if(data[i].tipo == "prato"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto_'+i+'">'+
	  						'<div class="promocao"></div>'+
								'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
								'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_desconto+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}else if(data[i].tipo=="dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto_'+i+'">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';

	  				}
	  			//Se não, mostre o prato normalmente
	  			}else{

	  				if(data[i].tipo == "prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto_'+i+'">'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto_'+i+'">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}
	  			}

	  		//Esconder o restante
	  		}else{
	  			//Se o contador estiver entre 0 e 2 e os pratos estiverem em promoção, mostrar a mensagem promoção
	  			if(data[i].esta_promocao > 0){

	  				if(data[i].tipo=="prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto_'+i+'" style="display:none">'+
	  								'<div class="promocao"></div>'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_desconto+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto_'+i+'" style="display:none">>'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}

	  			//Se não, mostre o prato normalmente
	  			}else{

	  				if(data[i].tipo == "prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto_'+i+'" style="display:none">'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
							}else if(data[i].tipo == "dieta"){
								HTMLpratos = HTMLpratos +'<div class="box_produto" id="produto_'+i+'" style="display:none">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
							}

	  			}
	  		}
	  	}



						$("#produtos_hipertrofia").html(HTMLpratos);

	  }
	});
}

function carregarEmagrecimento(){

	$.ajax({
	  type: "GET",
	  url: 'json/listar_pratos.php?tipo_dieta_id=1',
	  dataType: "json",
	  success: function(data){

	  	var HTMLpratos = "";



	  	//Listando os pratos...
	  	for(var i=0;i<data.length;i++){

	  		var HTMLpratos;

	  		var prato_id = data[i].prato_id;
			var nome = data[i].nome;
			var valor_unitario = data[i].valor_unitario;
			var valor_desconto = data[i].valor_desconto;
			var caminho_imagem = data[i].caminho_imagem;
			var tempo_preparo = data[i].tempo_preparo;
			var descricao = data[i].descricao;
			var tipo_dieta_id = data[i].tipo_dieta_id;
			var kcal_por_100g = data[i].kcal_por_100g;
			var peso = data[i].peso;
			var kcal_prato = data[i].kcal_prato;
			var esta_promocao = data[i].esta_promocao;

			//Formatando Título
			if(nome.length > 20){
				nome = nome.substr(0,20)+"...";
			}

			//Formatando descrição
			if(descricao.length > 45){
				descricao = descricao.substr(0,45)+"...";
			}

			//Formatando preços
			valor_unitario = "R$ "+valor_unitario.replace(".",",");
			if(valor_desconto != ""){
				valor_desconto = "R$ "+valor_desconto.replace(".",",");
			}

			kcal_prato = kcal_prato+"kcal";


	  		//Mostrar os 3 primeiros pratos
	  		if(i<=2){
	  			//Se o contador estiver entre 0 e 2 e os pratos estiverem em promoção, mostrar a mensagem promoção
	  			if(data[i].esta_promocao > 0){
	  				if(data[i].tipo=="prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto2_'+i+'">'+
	  								'<div class="promocao"></div>'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto2_'+i+'">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}


	  			//Se não, mostre o prato normalmente
	  			}else{

	  				if(data[i].tipo=="prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto2_'+i+'">'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto2_'+i+'">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}

	  			}

	  		//Esconder o restante
	  		}else{
	  			//Se o contador estiver entre 0 e 2 e os pratos estiverem em promoção, mostrar a mensagem promoção
	  			if(data[i].esta_promocao > 0){

	  				if(data[i].tipo=="prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto2_'+i+'" style="display:none">'+
	  								'<div class="promocao"></div>'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto2_'+i+'" style="display:none">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}


	  			//Se não, mostre o prato normalmente
	  			}else{

	  				if(data[i].tipo=="prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto2_'+i+'" style="display:none">'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto2_'+i+'" style="display:none">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}

	  			}
	  		}
	  	}



						$("#produtos_emagrecimento").html(HTMLpratos);

	  }
	});
}

// Responsivo
function carregarHipertrofiaResponsivo(){

	$.ajax({
	  type: "GET",
	  url: 'json/listar_pratos.php?tipo_dieta_id=2',
	  dataType: "json",
	  success: function(data){

	  	var HTMLpratos = "";



	  	//Listando os pratos...
	  	for(var i=0;i<data.length;i++){

	  		var HTMLpratos;

	  		var prato_id = data[i].prato_id;
			var nome = data[i].nome;
			var valor_unitario = data[i].valor_unitario;
			var valor_desconto = data[i].valor_desconto;
			var caminho_imagem = data[i].caminho_imagem;
			var descricao = data[i].descricao;
			var tipo_dieta_id = data[i].tipo_dieta_id;
			var kcal_por_100g = data[i].kcal_por_100g;
			var peso = data[i].peso;
			var kcal_prato = data[i].kcal_prato;
			var esta_promocao = data[i].esta_promocao;

			//Formatando Título
			if(nome.length > 20){
				nome = nome.substr(0,20)+"...";
			}

			//Formatando descrição
			if(descricao.length > 45){
				descricao = descricao.substr(0,53)+"...";
			}

			//Formatando preços
			valor_unitario = "R$ "+valor_unitario.replace(".",",");
			if(valor_desconto != ""){
				valor_desconto = "R$ "+valor_desconto.replace(".",",");
			}

			kcal_prato = kcal_prato+"kcal";


	  		//Mostrar os 3 primeiros pratos
	  		if(i<=0){
	  			//Se o contador estiver entre 0 e 2 e os pratos estiverem em promoção, mostrar a mensagem promoção
	  			if(data[i].esta_promocao > 0){
	  				if(data[i].tipo == "prato"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto_'+i+'">'+
	  						'<div class="promocao"></div>'+
								'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
								'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_desconto+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}else if(data[i].tipo=="dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto_'+i+'">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';

	  				}
	  			//Se não, mostre o prato normalmente
	  			}else{

	  				if(data[i].tipo == "prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto_'+i+'">'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto_'+i+'">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}
	  			}

	  		//Esconder o restante
	  		}else{
	  			//Se o contador estiver entre 0 e 2 e os pratos estiverem em promoção, mostrar a mensagem promoção
	  			if(data[i].esta_promocao > 0){

	  				if(data[i].tipo=="prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto_'+i+'" style="display:none">'+
	  								'<div class="promocao"></div>'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_desconto+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto_'+i+'" style="display:none">>'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}

	  			//Se não, mostre o prato normalmente
	  			}else{

	  				if(data[i].tipo == "prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto_'+i+'" style="display:none">'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
							}else if(data[i].tipo == "dieta"){
								HTMLpratos = HTMLpratos +'<div class="box_produto" id="produto_'+i+'" style="display:none">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
							}

	  			}
	  		}
	  	}



						$("#produtos_hipertrofia").html(HTMLpratos);

	  }
	});
}

function carregarEmagrecimentoResponsivo(){

	$.ajax({
	  type: "GET",
	  url: 'json/listar_pratos.php?tipo_dieta_id=1',
	  dataType: "json",
	  success: function(data){

	  	var HTMLpratos = "";



	  	//Listando os pratos...
	  	for(var i=0;i<data.length;i++){

	  		var HTMLpratos;

	  		var prato_id = data[i].prato_id;
			var nome = data[i].nome;
			var valor_unitario = data[i].valor_unitario;
			var valor_desconto = data[i].valor_desconto;
			var caminho_imagem = data[i].caminho_imagem;
			var tempo_preparo = data[i].tempo_preparo;
			var descricao = data[i].descricao;
			var tipo_dieta_id = data[i].tipo_dieta_id;
			var kcal_por_100g = data[i].kcal_por_100g;
			var peso = data[i].peso;
			var kcal_prato = data[i].kcal_prato;
			var esta_promocao = data[i].esta_promocao;

			//Formatando Título
			if(nome.length > 20){
				nome = nome.substr(0,20)+"...";
			}

			//Formatando descrição
			if(descricao.length > 45){
				descricao = descricao.substr(0,45)+"...";
			}

			//Formatando preços
			valor_unitario = "R$ "+valor_unitario.replace(".",",");
			if(valor_desconto != ""){
				valor_desconto = "R$ "+valor_desconto.replace(".",",");
			}

			kcal_prato = kcal_prato+"kcal";


	  		//Mostrar os 3 primeiros pratos
	  		if(i<=0){
	  			//Se o contador estiver entre 0 e 2 e os pratos estiverem em promoção, mostrar a mensagem promoção
	  			if(data[i].esta_promocao > 0){
	  				if(data[i].tipo=="prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto2_'+i+'">'+
	  								'<div class="promocao"></div>'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto2_'+i+'">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}


	  			//Se não, mostre o prato normalmente
	  			}else{

	  				if(data[i].tipo=="prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto2_'+i+'">'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto2_'+i+'">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}

	  			}

	  		//Esconder o restante
	  		}else{
	  			//Se o contador estiver entre 0 e 2 e os pratos estiverem em promoção, mostrar a mensagem promoção
	  			if(data[i].esta_promocao > 0){

	  				if(data[i].tipo=="prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto2_'+i+'" style="display:none">'+
	  								'<div class="promocao"></div>'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto2_'+i+'" style="display:none">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}


	  			//Se não, mostre o prato normalmente
	  			}else{

	  				if(data[i].tipo=="prato"){
	  					HTMLpratos = HTMLpratos + '<div class="box_produto" id="produto2_'+i+'" style="display:none">'+
									'<div class="box_img_produto" style="background-image:url(cms/'+caminho_imagem+')">'+
									'</div>'+
									'<div class="box_titulo_produto">'+
										nome +
									'</div>'+
									'<div class="box_descricao_produto">'+
										descricao +
									'</div>'+
									'<div class="preco_kcal">'+
										'<div class="preco">'+
											valor_unitario+
										'</div>'+
										'<div class="kcal">'+
											kcal_prato+
										'</div>'+
										'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_produto.php?prato_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>';
	  				}else if(data[i].tipo == "dieta"){
	  					HTMLpratos = HTMLpratos +
	  					'<div class="box_produto" id="produto2_'+i+'" style="display:none">'+
								'<div class="box_dieta" style="background-color:'+data[i].cor+'">'+
							  		'<div class="box_dias_dieta">'+
							  			'Quantidade de dias:<br>'+
							   	 		'<span class="dias_dieta">'+data[i].qtd_dias+' Dia(s)</span>'+
							  		'</div>'+
							      	'<div class="box_tipo_dieta">'+
							          data[i].tipo_dieta+
					      			'</div>'+
					      		'</div>'+
								'<div class="box_titulo_produto">'+
									nome +
								'</div>'+
								'<div class="box_descricao_produto">'+
									descricao +
								'</div>'+
								'<div class="preco_kcal">'+
									'<div class="preco">'+
										valor_unitario+
									'</div>'+
									'<div class="kcal">'+
										kcal_prato+
									'</div>'+
									'<div style="clear:both"></div>'+
									'</div>'+
									'<a class="box_item_menu_estilo" href="php/add_carrinho.php?action=insert&dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="comprar">'+
											'Comprar'+
										'</div>'+
									'</a>'+
									'<a class="box_item_menu_estilo" href="detalhes_dieta.php?dieta_id='+prato_id+'">'+
										'<div class="box_botao_produto" id="ver_detalhes">'+
											'Ver Detalhes'+
										'</div>'+
									'</a>'+
								'</div>'+
							'</form>';
	  				}

	  			}
	  		}
	  	}



						$("#produtos_emagrecimento").html(HTMLpratos);

	  }
	});
}


//SLIDER HIPERTROFIA
$(document).ready(function(){

	if ($(window).width() > 500) {

		var primeiro_prato = 0;
		var proximo_prato = 3;
		var ultimo_prato = 2;
		var anterior_primeiro_prato = -1;

		$(document).on("click","#proximo",function(){
			var quantidade_pratos = $("#produtos_hipertrofia .box_produto").size();

			if(proximo_prato!=quantidade_pratos){
				$("#produto_"+primeiro_prato).animate({
			    "margin-left":"-210px",
			    "opacity":0

			  	}, 400, function() {

			  	$("#produto_"+primeiro_prato).css("display","none");
			  	$("#produto_"+proximo_prato).css("opacity","1");
			    $("#produto_"+proximo_prato).fadeIn("fast");
			    primeiro_prato++;
			    proximo_prato++;
			    anterior_primeiro_prato++;
			    ultimo_prato++;
			 });
			}
		});

		$(document).on("click","#anterior",function(){
			var quantidade_pratos = $("#produtos_hipertrofia .box_produto").size();

			if(primeiro_prato!=0){

				$("#produto_"+ultimo_prato).animate({
			    "opacity":0

			  	}, 100, function() {

			 	});

				$("#produto_"+primeiro_prato).animate({
			    "margin-left":"210px",

			  	}, 400, function() {

				  	$("#produto_"+ultimo_prato).css("display","none");
				  	$("#produto_"+anterior_primeiro_prato).css("margin-left","30px");
				  	$("#produto_"+anterior_primeiro_prato).css("opacity","1");
				  	$("#produto_"+primeiro_prato).css("margin-left","30px");
				    $("#produto_"+anterior_primeiro_prato).fadeIn("fast");
				    primeiro_prato--;
				    proximo_prato--;
				    anterior_primeiro_prato--;
				    ultimo_prato--;
			 	});


			}
		});
	// Caso o dispositivo seja mobile
	} else {
		var primeiro_prato = 0;
		var proximo_prato = 1;
		var ultimo_prato = 0;
		var anterior_primeiro_prato = -1;

		$(document).on("click","#proximo",function(){
			var quantidade_pratos = $("#produtos_hipertrofia .box_produto").size();

			if(proximo_prato!=quantidade_pratos){
				$("#produto_"+primeiro_prato).animate({
			    "margin-left":"-210px",
			    "opacity":0

			  	}, 400, function() {

			  	$("#produto_"+primeiro_prato).css("display","none");
			  	$("#produto_"+proximo_prato).css("opacity","1");
			    $("#produto_"+proximo_prato).fadeIn("fast");
			    primeiro_prato++;
			    proximo_prato++;
			    anterior_primeiro_prato++;
			    ultimo_prato++;
			 });
			}
		});

		$(document).on("click","#anterior",function(){
			var quantidade_pratos = $("#produtos_hipertrofia .box_produto").size();

			if(primeiro_prato!=0){

				$("#produto_"+ultimo_prato).animate({
			    "opacity":0

			  	}, 100, function() {

			 	});

				$("#produto_"+primeiro_prato).animate({
			    "margin-left":"210px",

			  	}, 400, function() {

				  	$("#produto_"+ultimo_prato).css("display","none");
				  	$("#produto_"+anterior_primeiro_prato).css("margin-left","0");
				  	$("#produto_"+anterior_primeiro_prato).css("opacity","1");
				  	$("#produto_"+primeiro_prato).css("margin-left","0");
				    $("#produto_"+anterior_primeiro_prato).fadeIn("fast");
				    primeiro_prato--;
				    proximo_prato--;
				    anterior_primeiro_prato--;
				    ultimo_prato--;
			 	});


			}
		});
	}


	



});


//SLIDER EMAGRECIMENTO
$(document).ready(function(){

	if($(window).width() > 500){
		var primeiro_prato2 = 0;
		var proximo_prato2 = 3;
		var ultimo_prato2 = 2;
		var anterior_primeiro_prato2 = -1;

		$(document).on("click","#proximo2",function(){
			var quantidade_pratos2 = $("#produtos_emagrecimento .box_produto").size();

			if(proximo_prato2!=quantidade_pratos2){
				$("#produto2_"+primeiro_prato2).animate({
			    "margin-left":"-210px",
			    "opacity":0

			  }, 400, function() {

			  	$("#produto2_"+primeiro_prato2).css("display","none");
			  	$("#produto2_"+proximo_prato2).css("opacity","1");
			    $("#produto2_"+proximo_prato2).fadeIn("fast");
			    primeiro_prato2++;
			    proximo_prato2++;
			    anterior_primeiro_prato2++;
			    ultimo_prato2++;
			 });
			}
		});

		$(document).on("click","#anterior2",function(){
			var quantidade_pratos2 = $("#produtos_emagrecimento .box_produto").size();

			if(primeiro_prato2!=0){

				$("#produto2_"+ultimo_prato2).animate({
			    "opacity":0

			  	}, 100, function() {

			 	});

				$("#produto2_"+primeiro_prato2).animate({
			    "margin-left":"210px",

			  	}, 400, function() {

				  	$("#produto2_"+ultimo_prato2).css("display","none");
				  	$("#produto2_"+anterior_primeiro_prato2).css("margin-left","30px");
				  	$("#produto2_"+anterior_primeiro_prato2).css("opacity","1");
				  	$("#produto2_"+primeiro_prato2).css("margin-left","30px");
				    $("#produto2_"+anterior_primeiro_prato2).fadeIn("fast");
				    primeiro_prato2--;
				    proximo_prato2--;
				    anterior_primeiro_prato2--;
				    ultimo_prato2--;
			 	});


			}
		});
	}else{
		var primeiro_prato2 = 0;
		var proximo_prato2 = 1;
		var ultimo_prato2 = 0;
		var anterior_primeiro_prato2 = -1;

		$(document).on("click","#proximo2",function(){
			var quantidade_pratos2 = $("#produtos_emagrecimento .box_produto").size();

			if(proximo_prato2!=quantidade_pratos2){
				$("#produto2_"+primeiro_prato2).animate({
			    "margin-left":"-210px",
			    "opacity":0

			  }, 400, function() {

			  	$("#produto2_"+primeiro_prato2).css("display","none");
			  	$("#produto2_"+proximo_prato2).css("opacity","1");
			    $("#produto2_"+proximo_prato2).fadeIn("fast");
			    primeiro_prato2++;
			    proximo_prato2++;
			    anterior_primeiro_prato2++;
			    ultimo_prato2++;
			 });
			}
		});

		$(document).on("click","#anterior2",function(){
			var quantidade_pratos2 = $("#produtos_emagrecimento .box_produto").size();

			if(primeiro_prato2!=0){

				$("#produto2_"+ultimo_prato2).animate({
			    "opacity":0

			  	}, 100, function() {

			 	});

				$("#produto2_"+primeiro_prato2).animate({
			    "margin-left":"210px",

			  	}, 400, function() {

				  	$("#produto2_"+ultimo_prato2).css("display","none");
				  	$("#produto2_"+anterior_primeiro_prato2).css("margin-left","0");
				  	$("#produto2_"+anterior_primeiro_prato2).css("opacity","1");
				  	$("#produto2_"+primeiro_prato2).css("margin-left","0");
				    $("#produto2_"+anterior_primeiro_prato2).fadeIn("fast");
				    primeiro_prato2--;
				    proximo_prato2--;
				    anterior_primeiro_prato2--;
				    ultimo_prato2--;
			 	});


			}
		});
	}
	



});

/*
	Template de Efeitos
*/

var barra_busca_desceu = 0;

$(document).ready(function(){

	$(".box_logo").mouseover(function(){
		$('.box_logo').css('cursor', 'pointer');
	});

	$(".box_logo").click(function(){
		window.location.href = 'home.php';
	});


	if ($(window).width() < 500 ) {
	
		// var clicks = 0;

		// Se clicar no botão do menu principal
		$("#open_menu").click(function(){
			$('.box_login').toggle();
			$('.box_menu_caixa').toggle();

			$('.box_barra_busca').animate({"top":"-30%", "opacity":"0"});
			$("#barra_busca").css({'background-image':'url(img/lupa_icon.svg)', 'transition':'background 500ms ease'});
			barra_busca_desceu = 0;

			// Verificando se o menu está aberto, para deixá-lo em tela cheia
			/*if (clicks % 2) {
		        $('html, body').css("overflow", "auto");
		    } else {
		        $('html, body').css("overflow", "hidden");
		    }
		    ++clicks;*/
			
		});

		// Se clicar no botão do menu de páginas
		$("#menu_dropdown").click(function(){
			$(".box_item_menu").not("#menu_dropdown").slideToggle();
		});

		// Se clicar no botão de categorias
		$(".box_topo_menu_lateral").click(function(){
		   $(".box_conteudo_menu_lateral").slideToggle();
		});

		// Posicionando o menu, de acordo com a resolução
		if ($('.botao_login').length) {
			$('.box_menu_caixa').css('top', '45%');
		}

	}


});

$(document).ready(function(){

	$(document).on("click","#barra_busca",function(){
	
		// Se a resolução for de Desktop
		if ($(window).width() > 500) {

			if(barra_busca_desceu == 0){

				$("#barra_busca").css({
				    'background-image': 'url(img/subtracao_icon.png)',
				    'transition': 'background 500ms ease'
				});

				$(".box_barra_busca").animate({
			    	"top":"70px",
			  		}, 400, function() {
			 	});
			 	barra_busca_desceu = 1;
			} else {

				$("#barra_busca").css({
				    'background-image': 'url(img/lupa_icon.svg)',
				    'transition': 'background 500ms ease'
				});

				$(".box_barra_busca").animate({
			    	"top":"0px",
			  		}, 400, function() {
			 	});
			 	barra_busca_desceu = 0;
			}

		// Caso a resolução seja de Mobile
		} else {
			if(barra_busca_desceu == 0){

				$("#barra_busca").css({
				    'background-image': 'url(img/subtracao_icon.png)',
				    'transition': 'background 500ms ease'
				});

				$(".box_barra_busca").animate({
			    	// "display":"block",
			    	"top":"15%",
			    	"opacity": "1",
			  		}, 800, function() {
			 	});
			 	barra_busca_desceu = 1;
			} else {

				$("#barra_busca").css({
				    'background-image': 'url(img/lupa_icon.svg)',
				    'transition': 'background 500ms ease'
				});

				$(".box_barra_busca").animate({
			    	"top":"-30%",
			    	"opacity":"0",
			  		}, 800, function() {
			 	});
			 	barra_busca_desceu = 0;
			}
		}

	});

});

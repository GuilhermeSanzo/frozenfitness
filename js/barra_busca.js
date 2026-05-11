var barra_busca_desceu = 0;

$(document).ready(function(){

	$(document).on("click","#barra_busca",function(){
			
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
		}else{

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

	});

});

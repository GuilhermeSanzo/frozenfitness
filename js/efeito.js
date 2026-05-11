window.onload = function(){
	
slide();
	
function slide(){
	var list = $("#listSlide"); // Lista
	var left = $("#left");  // Botão Esquerdo
	var right = $("#right"); // Botão Direito
	var cx_pointer = $("#cx_pointer");
	var point = $(".point"); // Ponto de Indicação do Slide

	// Animation
	var speed = 300; // Velocidade da Animação
	var item = list.children().length - 2; // Quantidade de item da "<ul>"
	var firstItem = -1; // Primeiro Slide
	var lastItem = item; // Ultimo Slide
	var itemWidth = list.children().width(); // Tamanho do Item
	var initialPosition = - itemWidth; // Posição Inicial do Slide
	var finalPosition = initialPosition * item; // Posição Final do Slide
	var currentSlide = 0; // Slide Atual
	var end = true;
	
	var itemPoint = cx_pointer.children().length;

	// Slide Automático
	var time; // Slide Automático
	var interval = 1600; // Intervalo do Slide Automático
	var pCont = 0; // Contator do Índice do Item

	// Inicia o Slide
	startTime();
	pointSlide(pCont);

	// Momento do Mouse Sobre
	$(list).hover(function(event){
		var id = $(this).attr("id");
		if(hasList(id)) stopTime();
	});

	$(left).hover(function(event){
		var id = $(this).attr("id");
		if(hasList(id)) stopTime();
	});

	$(right).hover(function(event){
		var id = $(this).attr("id");
		if(hasList(id)) stopTime();
	});

	$(cx_pointer).hover(function(event){
		var id = $(this).attr("id");
		if(hasList(id)) stopTime();
	});


	// Momento do Mouse Fora
	$(list).mouseout(function(event){
		var id = $(this).attr("id");
		if(hasList(id)) startTime();
	});

	// Botão Direito
	right.on("click", function(){
		if(end){
			end = false;
			toRight(speed);
		}
	});

	// Botão Esquerdo
	left.on("click", function(){
		if(end){
			end = false;
			toLeft(speed);
		}
	});

	/* Mini botões (bolinhass)
	point.on("click", function(){
		if(end){
			end = false;
			//toPoint();
		}
	});*/

	// Inicia e Para o Slide Automático
	function startTime(){time = setInterval(toRight, interval);}
	function stopTime(){clearInterval(time);}

	// Animação dos Pontos de Indicação do Slide
	function pointSlide(pSlide){
		// Anterior
		point.css("opacity", "0.3");
		point.css("height", "15px");
		point.css("width", "15px");
		point.css("padding", "7px");

		// Atual
		
		point.get(pSlide).style.opacity = "0.6";
		point.get(pSlide).style.height = "20px";
		point.get(pSlide).style.width = "20px";
		point.get(pSlide).style.padding = "7px";
		
	}
	
	// Animação Slide para esquerda
	function toLeft(speed){
		pCont --;
		if(pCont < 0) pCont = item - 1;

		pointSlide(pCont);

		list.animate({
			left: "+=1000px"
		}, speed, function(){
			currentSlide --;

			// Verificando se é o ultimo item do Sldie
			if(currentSlide == firstItem){
				list.css("left", finalPosition);
				currentSlide = lastItem - 1;
			}

			pointSlide(currentSlide);
			end = true;
		});
	}

	// Animação Slide para direita
	function toRight(speed){
		pCont ++;
		if(pCont == item) pCont = 0;

		pointSlide(pCont);

		list.animate({
			left: "-=1000px"
		}, speed, function(){
			currentSlide ++;

			// Verificando se é o ultimo item do Sldie
			if(currentSlide == lastItem){
				list.css("left", initialPosition);
				currentSlide = firstItem + 1;
			}

			end = true;
		});
	}

	// Vai para 
	function toPoint() {
		cx_pointer.find( "span" ).css( "background-color", "red" );


		alert(point.nth());
	}

	// Verifica Se Existe ID na Lista
	function hasList(id){
		var has = false;

		switch(id){
			case "left":
				has = true;
				break;
			case "right":
				has = true;
				break;
			case "listSlide":
				has = true;
				break;
			case "cx_pointer":
				has = true;
				break;
		}

		return has;
	}
}

}
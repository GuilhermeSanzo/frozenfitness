/*

JS PARA CADASTRO DE PRATOS

*/

var id_dieta = "";
var lista_pratos_removidos = "";
var contador_ingrediente = 1;

$(document).ready(function(){

	
	
	//Preencher os ingredientes da lista de tipos ingredientes do primeiro item
	preencherListaCategoriaPrato2("#select_tipo_dieta0");
	preencherListaCategoriaPrato("#tipo_dieta_id");
	preencherDiaDaDieta("#select_dia_da_dieta0");
	preencherHorarioDaRefeicao("#select_horario_do_dia0");

	//Alterar os ingredientes conforme selecionar o tipo de prato
	$(document.body).on('change',".select_tipo_dieta",function (e) {

		var id_deste_select = $(this).attr("id");
   		var tipo_dieta_id = $("#"+id_deste_select + " option:selected").val();
   		var numero_do_id = id_deste_select.substr(id_deste_select.lastIndexOf("a")+1, id_deste_select.length);

   		if(tipo_dieta_id != ""){

   			//Se algum tipo de prato estiver selecionado.. libere as caixas
   			$("#select_prato"+numero_do_id).removeAttr("disabled");
   			$("#select_dia_da_dieta"+numero_do_id).removeAttr("disabled");
   			$("#select_prato"+numero_do_id).removeAttr("disabled");
   			$("#select_horario_do_dia"+numero_do_id).removeAttr("disabled");
   			
   			preencherListaPratos(tipo_dieta_id,"#select_prato"+numero_do_id);

   		}else{
   			//Se nenhum tipo de prato estiver selecionado.. bloqueie as caixas

   			$("#select_prato"+numero_do_id).attr("disabled","disabled");
   			$("#select_dia_da_dieta"+numero_do_id).attr("disabled","disabled");
   			$("#select_prato"+numero_do_id).attr("disabled","disabled");
   			$("#select_horario_do_dia"+numero_do_id).attr("disabled","disabled");
   			
   			resetarListaPrato("#select_prato"+numero_do_id);
   		}
	});

	//Alterar os ingredientes conforme selecionar o tipo de prato
	$(document.body).on('change',".select_prato",function (e) {

		var id_deste_select = $(this).attr("id");
   		var prato_id = $("#"+id_deste_select + " option:selected").val();
   		var numero_do_id = id_deste_select.substr(id_deste_select.lastIndexOf("o")+1, id_deste_select.length);

   		if(prato_id != ""){

   			alterar_imagem_prato(prato_id,"#img_prato"+numero_do_id);

   		}else{
   			$("#img_prato"+numero_do_id).css({
		   	 'background-image': 'url(img/ingrediente_icon.png)',
		   	 'transition': 'background 500ms ease'
			});
   		}
	});

	//Monta um novo prato vazio
	$(document).on("click","#adicionar_ingrediente",function (event) {
		event.preventDefault();
		$("#box_ingredientes").append('<div class="prato" id="prato'+contador_ingrediente+'">'+
	'<div class="img_prato" id="img_prato'+contador_ingrediente+'"></div> '+
	'<div class="img_pratos" id="img_pratos'+contador_ingrediente+'"></div> '+
	'<select required type="text" name="tipo_ingrediente" id="select_tipo_dieta'+contador_ingrediente+'" class="select_tipo_dieta">'+
	'</select> '+
	'<select required disabled class="select_prato" id="select_prato'+contador_ingrediente+'">'+
	'<option>Prato<option/> '+
	'</select> '+
	'<select required type="text" name="tipo_ingrediente" id="select_dia_da_dieta'+contador_ingrediente+'" class="select_dia_da_dieta">'+
	'</select> '+
	'<select required type="text" name="tipo_ingrediente" id="select_horario_do_dia'+contador_ingrediente+'" class="select_horario_do_dia">'+
	'</select> '+
	'<button class="btnRemove" id="btnRemove'+contador_ingrediente+'"></button>'+
	'<br><br>'+
	'</div>');
		preencherListaCategoriaPrato2("#select_tipo_dieta"+contador_ingrediente);
		preencherDiaDaDieta("#select_dia_da_dieta"+contador_ingrediente);
		preencherHorarioDaRefeicao("#select_horario_do_dia"+contador_ingrediente);
		contador_ingrediente++;
	});	

	//Monta um novo prato vazio no modo editar
	$(document).on("click","#adicionar_ingrediente_editar",function (event) {
		event.preventDefault();
		$("#box_ingredientes").append('<div class="prato" id="prato'+contador_ingrediente+'">'+
	'<div class="img_prato" id="img_prato'+contador_ingrediente+'"></div> '+
	'<div class="img_pratos" id="img_pratos'+contador_ingrediente+'"></div> '+
	'<select required type="text" name="tipo_ingrediente" id="select_tipo_dieta'+contador_ingrediente+'" class="select_tipo_dieta">'+
	'</select> '+
	'<select required disabled class="select_prato" id="select_prato'+contador_ingrediente+'">'+
	'<option>Prato<option/> '+
	'</select> '+
	'<select required type="text" name="tipo_ingrediente" id="select_dia_da_dieta'+contador_ingrediente+'" class="select_dia_da_dieta">'+
	'</select> '+
	'<select requiredtype="text" name="tipo_ingrediente" id="select_horario_do_dia'+contador_ingrediente+'" class="select_horario_do_dia">'+
	'</select> '+
	'<button class="btnRemoveEditar" id="btnRemoveEditars'+contador_ingrediente+'"></button>'+
	'<br><br>'+
	'</div>');
		preencherListaCategoriaPrato2("#select_tipo_dieta"+contador_ingrediente);
		preencherDiaDaDieta("#select_dia_da_dieta"+contador_ingrediente);
		preencherHorarioDaRefeicao("#select_horario_do_dia"+contador_ingrediente);
		contador_ingrediente++;
	});	


	//Remove o prato selecionado
	$(document).on("click", ".btnRemove", function(event){
		event.preventDefault();
		removerIngrediente("#"+$(this).parent().attr("id"));
	});

	//Remove o prato quando está em editar
	$(document).on("click", ".btnRemoveEditar", function(event){
		event.preventDefault();

		var id_deste_editar = $(this).attr("id");
   		var rel_prato_ingrediente_id = id_deste_editar.substr(id_deste_editar.lastIndexOf("r")+1, id_deste_editar.length);

		removerIngrediente("#"+$(this).parent().attr("id"));
		lista_pratos_removidos = lista_pratos_removidos + rel_prato_ingrediente_id+",";	

	});

	//Insere o prato
	$(document).on("click", "#btnInserir",function(event){
		event.preventDefault();

		if($(this).attr("value") == "Inserir"){
			inserirDieta();
		}else if($(this).attr("value") == "Editar"){
			atualizarDieta(id_dieta);
		}

	});

	//Excluir o Prato
	$(document).on("click",".excluir_dieta",function(){

		var id_deste_excluir = $(this).attr("id");
   		var dieta_id = id_deste_excluir.substr(id_deste_excluir.lastIndexOf("a")+1, id_deste_excluir.length);

		excluirDieta(dieta_id);

	});

	//Editar o Prato
	$(document).on("click",".editar_dieta",function(){

		var id_deste_excluir = $(this).attr("id");
   		var dieta_id = id_deste_excluir.substr(id_deste_excluir.lastIndexOf("a")+1, id_deste_excluir.length);

   		$("#adicionar_ingrediente").attr("id","adicionar_ingrediente_editar");

		editarDieta(dieta_id);

	});
});

function preencherListaCategoriaPrato(select){

	$.ajax({
	  type: "POST",
	  url: 'json/listar_tipo_dieta.php',
	  dataType: "json",
	  success: function(data){

	  	$(select).html("");
	  	$(select).append("<option value=''>Categoria da dieta</option>");
	  	$(select).append("<option value=''>---</option>");

	  	for(i=0;i<data.length;i++){
	  		$(select).append("<option value='"+data[i].tipo_dieta_id+"'>"+data[i].categoria_prato+"</option>");
	  	}
	  }
	});
}

function preencherListaCategoriaPrato2(select){

	$.ajax({
	  type: "POST",
	  url: 'json/listar_tipo_dieta.php',
	  dataType: "json",
	  success: function(data){

	  	$(select).html("");
	  	$(select).append("<option value=''>Categoria do Prato</option>");
	  	$(select).append("<option value=''>---</option>");

	  	for(i=0;i<data.length;i++){
	  		$(select).append("<option value='"+data[i].tipo_dieta_id+"'>"+data[i].categoria_prato+"</option>");
	  	}
	  }
	});
}

function preencherListaPratos(tipo_dieta_id,select){

	$.ajax({
	  type: "POST",
	  url: 'json/listar_pratos.php',
	  data: {"tipo_dieta_id":tipo_dieta_id},
	  dataType: "json",
	  success: function(data){

	  	$(select).html("");
	  	$(select).append("<option value=''>Prato</option>");
	  	$(select).append("<option value=''>---</option>");

	  	for(i=0;i<data.length;i++){
	  		$(select).append("<option value='"+data[i].prato_id+"'>"+data[i].prato+"</option>");
	  	}
	  }
	});
}

function preencherDiaDaDieta(select){

	$(select).html("");
	$(select).append("<option value=''>Dia da Dieta</option>");
	$(select).append("<option value=''>---</option>");

	for(i=1;i<=31;i++){
		$(select).append("<option value='"+i+"'>"+i+"º Dia</option>");
	}
	
}

function preencherHorarioDaRefeicao(select){

	$.ajax({
	  type: "GET",
	  url: 'json/listar_horario_do_dia.php',
	  dataType: "json",
	  success: function(data){

	  	$(select).html("");
	  	$(select).append("<option value=''>Horario da Refeição</option>");
	  	$(select).append("<option value=''>---</option>");

	  	for(i=0;i<data.length;i++){
	  		$(select).append("<option value='"+data[i].horario_do_dia_id+"'>"+data[i].horario_do_dia+"</option>");
	  	}
	  }
	});
	
}

function removerIngrediente(select){

	$(select).fadeOut();
	setTimeout(function(){
		$(select).remove();
	},500);
}

function resetarListaPrato(select){
	$(select).html("");
	$(select).append("<option value=''>Prato</option>");
}





// CRUD 

function inserirDieta(){

    var formData = new FormData($('form')[1]);
    var verificacao = true;

    var qtdIngredientes = $(".prato").size();

    var txtNome = $("#txtNome").val();
    var txtDescricao = $("#txtDescricao").val();
    var tipo_dieta_id = $("#tipo_dieta_id").val();

    if(txtNome == undefined || txtDescricao == undefined || tipo_dieta_id == undefined  || txtNome == "" || txtDescricao == "" || tipo_dieta_id == "" ){
		verificacao = false;
	}

	if(verificacao){
		for(var i=0; i<qtdIngredientes; i++){

			var dieta_id = dieta_id;
			var prato_id = $(".select_prato:eq("+i+")").val();
			var dia_da_dieta = $(".select_dia_da_dieta:eq("+i+")").val();
			var horario_do_dia = $(".select_horario_do_dia:eq("+i+")").val();

			if(prato_id == undefined || dia_da_dieta == undefined || horario_do_dia == undefined  || prato_id == "" || dia_da_dieta == "" || horario_do_dia == "" ){
				verificacao = false;
			}
		}

	    if(verificacao){
	    	$.ajax({
		        url: 'php/crud_dieta.php?inserir=0',  //Server script to process data
		        type: 'POST',
		        dataType:'json',
		        success: function(data){
		        	if(data.resultado == "1"){
		        		inserirPratos(data.dieta_id);
		        	}else{
		        		
		        	}
		        },
		        // Form data
		        data: formData,
		        //Options to tell jQuery not to process data or worry about content-type.
		        cache: false,
		        contentType: false,
		        processData: false
		    });
	    }else{
	    	alert("Por favor, preencha todos os campos dos pratos a serem cadastrados.");
	    }
	}else{
		alert("Por favor, preencha todos os campos para cadastro da dieta");
	}

	
    
}

function inserirPratos(dieta_id){

	var qtdIngredientes = $(".prato").size();

	for(var i=0; i<qtdIngredientes; i++){

		var dieta_id = dieta_id;
		var prato_id = $(".select_prato:eq("+i+")").val();
		var dia_da_dieta = $(".select_dia_da_dieta:eq("+i+")").val();
		var horario_do_dia = $(".select_horario_do_dia:eq("+i+")").val();

		$.ajax({
	        url: 'php/crud_dieta.php?inserir_prato=0&dieta_id='+dieta_id+'&dia_da_dieta='+dia_da_dieta+'&horario_do_dia='+horario_do_dia+'&prato_id='+prato_id,  //Server script to process data
	        type: 'GET',
	        dataType:'json',
	        success: function(data){
	        	
	        },
	        // Form data
	        
	        //Options to tell jQuery not to process data or worry about content-type.
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	}
	window.location.replace("cadastro_dieta.php");
}


function excluirDieta(dieta_id){


	$.ajax({
	        url: 'php/crud_dieta.php?excluir_dieta=0&dieta_id='+dieta_id+"",  //Server script to process data
	        type: 'GET',
	        dataType:'json',
	        success: function(data){
	        	if(data.resultado == "1"){
	        		window.location.replace("cadastro_dieta.php");
	        	}else{
		        	window.location.replace("cadastro_dieta.php");		
	        	}
	        },
	        // Form data
	        
	        //Options to tell jQuery not to process data or worry about content-type.
	        cache: false,
	        contentType: false,
	        processData: false
	    });
}

function editarDieta(dieta_id){

	id_dieta = dieta_id;

	$.ajax({
	        url: 'php/crud_dieta.php?editar_dieta=0&dieta_id='+dieta_id+"",  //Server script to process data
	        type: 'GET',
	        dataType:'json',
	        success: function(data){
	        	if(data.resultado == "1"){
	        		$('#txtNome').val(data.nome);
					$('#txtDescricao').val(data.descricao);
					
					var HTMLListarTipoDieta = "";

					var HTMLprato = "";
					var HTMLpratos = "";
					var HTMLTiposDieta = "";
					var HTMLdia = "";
					var HTMLHorarioDia = "";

					for(var i=0 ; i<data.tipos_dieta.length ; i++){
						HTMLListarTipoDieta = HTMLListarTipoDieta + "<option value='"+data.tipos_dieta[i].tipo_dieta_id+"'>"+data.tipos_dieta[i].tipo_dieta+"</option>";
					}

					for(var i=0 ; i<data.pratos.length ; i++){
						HTMLpratos = HTMLpratos + "<option value='"+data.pratos[i].prato_id+"'>"+data.pratos[i].prato+"</option>";
					}

					for(i=1;i<=31;i++){
						HTMLdia = HTMLdia + "<option value='"+i+"'>"+i+"º Dia</option>";
					}

					for(var i=0 ; i<data.horarios_do_dia.length ; i++){
						HTMLHorarioDia = HTMLHorarioDia + "<option value='"+data.horarios_do_dia[i].horario_do_dia_id+"'>"+data.horarios_do_dia[i].horario_do_dia+"</option>";
					}


					for(var i=0 ; i<data.pratos_da_dieta.length ; i++){
						
						HTMLprato = HTMLprato + 
						"<div class='prato' id='prato"+i+"'>"+
							"<div class='img_prato' id='img_prato"+i+"' style='background-image: url("+data.pratos_da_dieta[i].caminho_imagem+")'></div>"+
							"<select required type='text' id='select_tipo_dieta"+i+"' class='select_tipo_dieta'>"+
								"<option value='"+data.pratos_da_dieta[i].tipo_dieta_id+"'>"+data.pratos_da_dieta[i].tipo_dieta+"</option>"+
								"<option value=''>---</option>"+
								HTMLListarTipoDieta+
							"</select> "+
							"<select required class='select_prato' id='select_prato"+i+"'>"+
								"<option value='"+data.pratos_da_dieta[i].prato_id+"'>"+data.pratos_da_dieta[i].prato+"</option>"+
								"<option value=''>---</option>"+
								HTMLpratos+
							"</select> "+
							"<select required type='text' name='tipo_ingrediente' id='select_dia_da_dieta"+i+"' class='select_dia_da_dieta'>"+
								"<option value='"+data.pratos_da_dieta[i].dia+"'>"+data.pratos_da_dieta[i].dia+"º Dia</option>"+
								"<option value=''>---</option>"+
								HTMLdia+
							"</select> "+
							"<select required type='text' name='tipo_ingrediente' id='select_horario_do_dia"+i+"' class='select_horario_do_dia'>"+
								"<option value='"+data.pratos_da_dieta[i].horario_do_dia_id+"'>"+data.pratos_da_dieta[i].horario_do_dia+"</option>"+
								"<option value=''>---</option>"+
								HTMLHorarioDia+
							"</select> "+
							"<button class='btnRemoveEditar' id='btnRemoveEditar"+data.pratos_da_dieta[i].rel_dieta_prato_id+"'></button>"+
							"<br><br>"+
						"</div>";
						
						contador_ingrediente++;
					}

					$("#box_ingredientes").html(HTMLprato);
					$("#tipo_dieta_id").html("");
					$("#tipo_dieta_id").append("<option value='"+data.tipo_dieta_id+"'>"+data.tipo_dieta+"</option><option value=''>---</option>");
					$("#tipo_dieta_id").append(HTMLListarTipoDieta);

					$("#btnInserir").val("Editar");
	        	}else{
		        	alert("Ocorreu um erro durante a edição de pratos");
	        	}
	        },
	        // Form data
	        
	        //Options to tell jQuery not to process data or worry about content-type.
	        cache: false,
	        contentType: false,
	        processData: false
	    });
}

function atualizarDieta(dieta_id){
	
	var formData = new FormData($('form')[1]);

	var verificacao = true;

    var qtdIngredientes = $(".prato").size();

    var txtNome = $("#txtNome").val();
    var txtDescricao = $("#txtDescricao").val();
    var tipo_dieta_id = $("#tipo_dieta_id").val();

    if(txtNome == undefined || txtDescricao == undefined || tipo_dieta_id == undefined  || txtNome == "" || txtDescricao == "" || tipo_dieta_id == "" ){
		verificacao = false;
	}

	if(verificacao){
		for(var i=0; i<qtdIngredientes; i++){

			var dieta_id = dieta_id;
			var prato_id = $(".select_prato:eq("+i+")").val();
			var dia_da_dieta = $(".select_dia_da_dieta:eq("+i+")").val();
			var horario_do_dia = $(".select_horario_do_dia:eq("+i+")").val();

			if(prato_id == undefined || dia_da_dieta == undefined || horario_do_dia == undefined  || prato_id == "" || dia_da_dieta == "" || horario_do_dia == "" ){
				verificacao = false;
			}
		}

	    if(verificacao){
	    	$.ajax({
		        url: 'php/crud_dieta.php?atualizar_dieta=0&dieta_id='+dieta_id,  //Server script to process data
		        type: 'POST',
		        dataType:'json',
		        success: function(data){
		        	if(data.resultado == "1"){
		        		atualizarIngredientes(dieta_id);
		        	}else{
		        		alert("Ocorreu um erro durante a edição de produtos");
		        	}
		        },
		        // Form data
		        data: formData,
		        //Options to tell jQuery not to process data or worry about content-type.
		        cache: false,
		        contentType: false,
		        processData: false
		    });

	    }else{
	    	alert("Por favor, preencha todos os campos dos pratos a serem editados.");
	    }
	}else{
		alert("Por favor, preencha todos os campos para a edição da dieta");
	}


    
}

function atualizarIngredientes(dieta_id){
	var qtdIngredientes = $(".prato").size();

	lista_pratos_removidos = lista_pratos_removidos.substr(0,lista_pratos_removidos.length-1);
	
	if(lista_pratos_removidos != ""){
		lista_pratos_removidos = ","+lista_pratos_removidos;
	}

	$.ajax({
        url: 'php/crud_dieta.php?lista_pratos_removidos='+lista_pratos_removidos,  //Server script to process data
        type: 'POST',
        dataType:'json',
        success: function(data){
        	if(data.resultado == "1"){
        		
        		var qtdIngredientes = $(".prato").size();

				for(var i=0; i<qtdIngredientes; i++){
					
					var prato_id = $(".select_prato:eq("+i+")").val();
					var dia_da_dieta = $(".select_dia_da_dieta:eq("+i+")").val();
					var horario_do_dia = $(".select_horario_do_dia:eq("+i+")").val();

					var id_deste_rel_dieta_id = $(".btnRemoveEditar:eq("+i+")").attr("id");
   					var rel_dieta_prato_id = id_deste_rel_dieta_id.substr(id_deste_rel_dieta_id.lastIndexOf("r")+1, id_deste_rel_dieta_id.length);
	
					
					$.ajax({
				        url: 'php/crud_dieta.php?atualizar_pratos=0&dieta_id='+dieta_id+'&prato_id='+prato_id+'&dia_da_dieta='+dia_da_dieta+"&rel_dieta_prato_id="+rel_dieta_prato_id+"&horario_do_dia="+horario_do_dia,  //Server script to process data
				        type: 'GET',
				        dataType:'json',
				        success: function(data){
				        	
				        },
				        cache: false,
				        contentType: false,
				        processData: false
				    });
				}	
				window.location.replace("cadastro_dieta.php");
        	}else{
        		alert("Ocorreu um erro durante a edição de produtos");
        	}
        },
        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
}

function alterar_imagem_prato(prato_id,img_prato){
	$.ajax({
	  type: "GET",
	  url: 'json/listar_pratos.php?prato_id='+prato_id,
	  dataType: "json",
	  success: function(data){

	  	$(img_prato).css({
		    'background-image': 'url('+data.caminho_imagem+')',
		    'transition': 'background 500ms ease'
		});
	  }
	});
}




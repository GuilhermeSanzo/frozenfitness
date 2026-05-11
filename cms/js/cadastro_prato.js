/*

JS PARA CADASTRO DE PRATOS

*/

var id_prato = "";
var lista_ingredientes_removidos = "";
var contador_ingrediente = 1;

$(document).ready(function(){

	jQuery(function($){
		$("#txtValidade").mask("000000");
		$("#txtTempoPreparo").mask("000000");
		$("#txtValorUnitario").mask('000000000000.00', {reverse: true});
		$(".txtQuantidade").mask('000');
	});

	//Preencher os ingredientes da lista de tipos ingredientes do primeiro item
	preencherListaTipoIngrediente("#select_tipo_ingrediente0");
	preencherListaCategoriaPrato("#tipo_dieta_id");

	//Alterar os ingredientes conforme selecionar o tipo de ingrediente
	$(document.body).on('change',".select_tipo_ingrediente",function (e) {

		var id_deste_select = $(this).attr("id");
   		var tipo_ingrediente_id = $("#"+id_deste_select + " option:selected").val();
   		var numero_do_id = id_deste_select.substr(id_deste_select.lastIndexOf("e")+1, id_deste_select.length);

   		if(tipo_ingrediente_id != ""){

   			//Se algum tipo de ingrediente estiver selecionado.. libere as caixas
   			$("#select_ingrediente"+numero_do_id).removeAttr("disabled");
   			$("#txtQuantidade"+numero_do_id).removeAttr("readonly");
   			
   			preencherListaIngredientes(tipo_ingrediente_id,"#select_ingrediente"+numero_do_id);

   		}else{
   			//Se nenhum tipo de ingrediente estiver selecionado.. bloqueie as caixas
   			$("#select_ingrediente"+numero_do_id).attr("disabled","disabled");
   			$("#txtQuantidade"+numero_do_id).attr("readonly","readonly");
   			resetarListaIngrediente("#select_ingrediente"+numero_do_id);
   		}
	});

	//Alterar os ingredientes conforme selecionar o tipo de ingrediente
	$(document.body).on('change',".select_ingrediente",function (e) {

		var id_deste_select = $(this).attr("id");
   		var ingrediente_id = $("#"+id_deste_select + " option:selected").val();
   		var numero_do_id = id_deste_select.substr(id_deste_select.lastIndexOf("e")+1, id_deste_select.length);

   		if(ingrediente_id != ""){

   			alterar_imagem_ingrediente(ingrediente_id,"#img_ingrediente"+numero_do_id);

   		}else{
   			$("#img_ingrediente"+numero_do_id).css({
		   	 'background-image': 'url(img/ingrediente_icon.png)',
		   	 'transition': 'background 500ms ease'
			});
   		}
	});

	//Monta um novo ingrediente vazio
	$(document).on("click","#adicionar_ingrediente",function (event) {
		event.preventDefault();
		$("#box_ingredientes").append('<div class="ingrediente" id="ingrediente'+contador_ingrediente+'"> <div class="img_ingrediente" id="img_ingrediente'+contador_ingrediente+'"></div> <select type="text" name="tipo_ingrediente" class="select_tipo_ingrediente" id="select_tipo_ingrediente'+contador_ingrediente+'">" <option value="<?php echo $value_tipo_ingrediente ?>"><?php echo $tipo_ingrediente ?></option>"<?php $conexao = connect();$sql = "select * from tipo_ingrediente";$select = mysqli_query($conexao,$sql);while($array = mysqli_fetch_array($select)){echo "<option value=".$array["tipo_ingrediente_id"].">".$array["nome"]."</option>";}?> </select> <select disabled class="select_ingrediente" id="select_ingrediente'+contador_ingrediente+'"> <option>Ingrediente</option></select> <input class="txtQuantidade" id="txtQuantidade'+contador_ingrediente+'" type="text" placeholder="Peso em Gramas" readonly><span>g </span><button class="btnRemove" id="btnRemove'+contador_ingrediente+'"></button><br><br>');
		preencherListaTipoIngrediente("#select_tipo_ingrediente"+contador_ingrediente);
		contador_ingrediente++;
	});	

	//Monta um novo ingrediente vazio no modo editar
	$(document).on("click","#adicionar_ingrediente_editar",function (event) {
		event.preventDefault();
		$("#box_ingredientes").append('<div class="ingrediente" id="ingrediente'+contador_ingrediente+'"><div class="img_ingrediente" id="img_ingrediente'+contador_ingrediente+'"></div><select type="text" name="tipo_ingrediente" class="select_tipo_ingrediente" id="select_tipo_ingrediente'+contador_ingrediente+'">" <option value=""></option></option></select><select disabled class="select_ingrediente" id="select_ingrediente'+contador_ingrediente+'"><option>Ingrediente</option></select> <input class="txtQuantidade" id="txtQuantidade'+contador_ingrediente+'" type="text" placeholder="Peso em Gramas" readonly><span>g </span><button class="btnRemoveEditar" id="btnRemoveEditars'+contador_ingrediente+'"></button><br><br>');
		preencherListaTipoIngrediente("#select_tipo_ingrediente"+contador_ingrediente);
		contador_ingrediente++;
	});	


	//Remove o ingrediente selecionado
	$(document).on("click", ".btnRemove", function(event){
		event.preventDefault();
		removerIngrediente("#"+$(this).parent().attr("id"));
	});

	//Remove o ingrediente quando está em editar
	$(document).on("click", ".btnRemoveEditar", function(event){
		event.preventDefault();

		var id_deste_editar = $(this).attr("id");
   		var rel_prato_ingrediente_id = id_deste_editar.substr(id_deste_editar.lastIndexOf("r")+1, id_deste_editar.length);

		removerIngrediente("#"+$(this).parent().attr("id"));
		lista_ingredientes_removidos = lista_ingredientes_removidos + rel_prato_ingrediente_id+",";	

	});

	//Insere o prato
	$(document).on("click", "#btnInserir",function(event){
		event.preventDefault();

		if($(this).attr("value") == "Inserir"){
			inserirPrato();
		}else if($(this).attr("value") == "Editar"){
			atualizarPrato(id_prato);
		}

	});

	//Excluir o Prato
	$(document).on("click",".excluir_prato",function(){

		var id_deste_excluir = $(this).attr("id");
   		var prato_id = id_deste_excluir.substr(id_deste_excluir.lastIndexOf("o")+1, id_deste_excluir.length);

		excluirPrato(prato_id);

	});

	//Editar o Prato
	$(document).on("click",".editar_prato",function(){

		var id_deste_excluir = $(this).attr("id");
   		var prato_id = id_deste_excluir.substr(id_deste_excluir.lastIndexOf("o")+1, id_deste_excluir.length);

   		$("#adicionar_ingrediente").attr("id","adicionar_ingrediente_editar");

		editarPrato(prato_id);

	});
});

function preencherListaCategoriaPrato(select){

	$.ajax({
	  type: "POST",
	  url: 'json/listar_tipo_dieta.php',
	  dataType: "json",
	  success: function(data){

	  	$(select).html("");
	  	$(select).append("<option value=''>Categoria do prato</option>");
	  	$(select).append("<option value=''>---</option>");

	  	for(i=0;i<data.length;i++){
	  		$(select).append("<option value='"+data[i].tipo_dieta_id+"'>"+data[i].categoria_prato+"</option>");
	  	}
	  }
	});
}

function preencherListaIngredientes(tipo_ingrediente_id,select){

	$.ajax({
	  type: "POST",
	  url: 'json/listar_ingredientes.php',
	  data: {"tipo_ingrediente_id":tipo_ingrediente_id},
	  dataType: "json",
	  success: function(data){

	  	$(select).html("");
	  	$(select).append("<option value=''>Ingrediente</option>");
	  	$(select).append("<option value=''>---</option>");

	  	for(i=0;i<data.length;i++){
	  		$(select).append("<option value='"+data[i].ingrediente_id+"'>"+data[i].ingrediente+"</option>");
	  	}
	  }
	});
}

function preencherListaTipoIngrediente(select){

	$.ajax({
	  type: "GET",
	  url: 'json/listar_tipo_ingrediente.php',
	  dataType: "json",
	  success: function(data){

	  	$(select).html("");
	  	$(select).append("<option value=''>Tipo de Ingrediente</option>");
	  	$(select).append("<option value=''>---</option>");

	  	for(i=0;i<data.length;i++){
	  		$(select).append("<option value='"+data[i].tipo_ingrediente_id+"'>"+data[i].tipo_ingrediente+"</option>");
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



function resetarListaIngrediente(select){
	$(select).html("");
	$(select).append("<option value=''>Ingrediente</option>");
}



function inserirPrato(){

    var formData = new FormData($('form')[1]);
    var verificacao = true;

    var qtdIngredientes = $(".ingrediente").size();

    var txtNome = $("#txtNome").val();
	var txtDescricao = $("#txtDescricao").val();
	var tipo_dieta_id = $("#tipo_dieta_id").val();
	var txtValidade = $("#txtValidade").val();
	var txtTempoPreparo = $("#txtTempoPreparo").val();
	var txtValorUnitario = $("#txtValorUnitario").val();

    if(txtNome == undefined || txtDescricao == undefined || tipo_dieta_id == undefined || txtValidade == undefined || txtTempoPreparo == undefined || txtValorUnitario == undefined || txtNome == "" || txtDescricao == "" || tipo_dieta_id == "" || txtValidade == "" || txtTempoPreparo == "" || txtValorUnitario == ""){
		verificacao = false;
	}

	if(verificacao){
		for(var i=0; i<qtdIngredientes; i++){

			var ingrediente_id = $(".select_ingrediente:eq("+i+")").val();
			var quantidade = $(".txtQuantidade:eq("+i+")").val();

			if(ingrediente_id == undefined || quantidade == undefined  || ingrediente_id == "" || quantidade == "" ){
				verificacao = false;
			}
		}

	    if(verificacao){
	    	 $.ajax({
		        url: 'php/crud_prato.php?inserir=0',  //Server script to process data
		        type: 'POST',
		        dataType:'json',
		        success: function(data){
		        	if(data.resultado == "1"){
		        		inserirIngredientes(data.prato_id);
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
	    	alert("Por favor, preencha todos os campos dos ingredientes a serem cadastrados.");
	    }
	}else{
		alert("Por favor, preencha todos os campos para cadastrar o prato");
	}
}

function inserirIngredientes(prato_id){

	var qtdIngredientes = $(".ingrediente").size();

	for(var i=0; i<qtdIngredientes; i++){

		var prato_id = prato_id;
		var ingrediente_id = $(".select_ingrediente:eq("+i+")").val();
		var quantidade = $(".txtQuantidade:eq("+i+")").val();

		$.ajax({
	        url: 'php/crud_prato.php?inserir_ingrediente=0&prato_id='+prato_id+'&ingrediente_id='+ingrediente_id+'&quantidade='+quantidade,  //Server script to process data
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
	window.location.replace("cadastro_prato.php");
}


function excluirPrato(prato_id){


	$.ajax({
	        url: 'php/crud_prato.php?excluir_prato=0&prato_id='+prato_id+"",  //Server script to process data
	        type: 'GET',
	        dataType:'json',
	        success: function(data){
	        	if(data.resultado == "1"){
	        		window.location.replace("cadastro_prato.php");
	        	}else{
		        	window.location.replace("cadastro_prato.php");		
	        	}
	        },
	        // Form data
	        
	        //Options to tell jQuery not to process data or worry about content-type.
	        cache: false,
	        contentType: false,
	        processData: false
	    });
}

function editarPrato(prato_id){

	id_prato = prato_id;

	$.ajax({
	        url: 'php/crud_prato.php?editar_prato=0&prato_id='+prato_id+"",  //Server script to process data
	        type: 'GET',
	        dataType:'json',
	        success: function(data){
	        	if(data.resultado == "1"){
	        		$('#txtNome').val(data.nome);
					$('#txtValidade').val(data.validade);
					$('#txtValorUnitario').val(data.valor_unitario);
					$('#txtTempoPreparo').val(data.tempo_preparo);
					$('#txtDescricao').val(data.descricao);
					
					var HTMLListarTipoDieta = "";
					var HTMLingrediente = "";
					var HTMLListarIngredientes = "";
					var HTMLListarTipoIngredientes = "";

					HTMLListarTipoDieta = "<option value='"+data.tipo_dieta_id+"'>"+data.categoria_prato+"</option>";
					HTMLListarTipoDieta = HTMLListarTipoDieta + "<option value=''>---</option>";

					for(var i=0 ; i<data.tipos_dieta.length ; i++){
						HTMLListarTipoDieta = HTMLListarTipoDieta + "<option value='"+data.tipos_dieta[i].tipo_dieta_id+"'>"+data.tipos_dieta[i].categoria_prato+"</option>";
					}

					for(var i=0 ; i<data.ingredientes.length ; i++){
						HTMLListarIngredientes = HTMLListarIngredientes + "<option value='"+data.ingredientes[i].ingrediente_id+"'>"+data.ingredientes[i].ingrediente+"</option>";
					}

					for(var i=0 ; i<data.tipos_ingredientes.length ; i++){
						HTMLListarTipoIngredientes = HTMLListarTipoIngredientes + "<option value='"+data.tipos_ingredientes[i].tipo_ingrediente_id+"'>"+data.tipos_ingredientes[i].tipo_ingrediente+"</option>";
					}


					for(var i=0 ; i<data.ingredientes_do_prato.length ; i++){
						HTMLingrediente = HTMLingrediente + "<div class='ingrediente' id='ingrediente"+i+"'>"+
						"<div class='img_ingrediente' id='img_ingrediente"+i+"' style='background-image:url("+data.ingredientes_do_prato[i].caminho_imagem+")'></div>"+
						"<select type='text' name='tipo_ingrediente' id='select_tipo_ingrediente"+i+"' class='select_tipo_ingrediente'>"+
							"<option value='"+data.ingredientes_do_prato[i].tipo_ingrediente_id+"'>"+data.ingredientes_do_prato[i].tipo_ingrediente+"</option>"+
							"<option value=''>---</option>"+
							HTMLListarTipoIngredientes+
						"</select>"+
						"<select class='select_ingrediente' id='select_ingrediente"+i+"'>"+
							"<option value='"+data.ingredientes_do_prato[i].ingrediente_id+"'>"+data.ingredientes_do_prato[i].ingrediente+"</option>"+
							"<option value=''>---</option>"+
							HTMLListarIngredientes+
						"</select>"+
						"<input class='txtQuantidade' id='txtQuantidade"+i+"' type='text' placeholder='Peso em Gramas' value="+data.ingredientes_do_prato[i].qtd+"><span>g</span>"+
						"<button class='btnRemoveEditar' id='btnRemoveEditar"+data.ingredientes_do_prato[i].rel_prato_ingrediente_id+"'>"+
						"</button>"+
						"<br><br>"+
					"</div>";
						
						contador_ingrediente++;
					}

					$("#box_ingredientes").html(HTMLingrediente);
					$("#tipo_dieta_id").html(HTMLListarTipoDieta);

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

function atualizarPrato(prato_id){
	
	var formData = new FormData($('form')[1]);

	var verificacao = true;

    var qtdIngredientes = $(".ingrediente").size();

    var txtNome = $("#txtNome").val();
	var txtDescricao = $("#txtDescricao").val();
	var tipo_dieta_id = $("#tipo_dieta_id").val();
	var txtValidade = $("#txtValidade").val();
	var txtTempoPreparo = $("#txtTempoPreparo").val();
	var txtValorUnitario = $("#txtValorUnitario").val();

    if(txtNome == undefined || txtDescricao == undefined || tipo_dieta_id == undefined || txtValidade == undefined || txtTempoPreparo == undefined || txtValorUnitario == undefined || txtNome == "" || txtDescricao == "" || tipo_dieta_id == "" || txtValidade == "" || txtTempoPreparo == "" || txtValorUnitario == ""){
		verificacao = false;
	}

	if(verificacao){
		for(var i=0; i<qtdIngredientes; i++){

			var ingrediente_id = $(".select_ingrediente:eq("+i+")").val();
			var quantidade = $(".txtQuantidade:eq("+i+")").val();

			if(ingrediente_id == undefined || quantidade == undefined  || ingrediente_id == "" || quantidade == "" ){
				verificacao = false;
			}
		}

	    if(verificacao){
	    	 $.ajax({
		        url: 'php/crud_prato.php?atualizar_prato=0&prato_id='+prato_id,  //Server script to process data
		        type: 'POST',
		        dataType:'json',
		        success: function(data){
		        	if(data.resultado == "1"){
		        		atualizarIngredientes(prato_id);
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
	    	alert("Por favor, preencha todos os campos dos ingredientes a serem cadastrados.");
	    }
	}else{
		alert("Por favor, preencha todos os campos para cadastrar o prato");
	}
}

function atualizarIngredientes(prato_id){
	var qtdIngredientes = $(".ingrediente").size();

	lista_ingredientes_removidos = lista_ingredientes_removidos.substr(0,lista_ingredientes_removidos.length-1);
	
	if(lista_ingredientes_removidos != ""){
		lista_ingredientes_removidos = ","+lista_ingredientes_removidos;
	}

	$.ajax({
        url: 'php/crud_prato.php?lista_ingredientes_removidos='+lista_ingredientes_removidos,  //Server script to process data
        type: 'POST',
        dataType:'json',
        success: function(data){
        	if(data.resultado == "1"){
        		
        		var qtdIngredientes = $(".ingrediente").size();

				for(var i=0; i<qtdIngredientes; i++){
					var ingrediente_id = $(".select_ingrediente:eq("+i+")").val();
					var quantidade = $(".txtQuantidade:eq("+i+")").val();
					var id_deste_rel_ingrediente_id = $(".btnRemoveEditar:eq("+i+")").attr("id");
   					var rel_prato_ingrediente_id = id_deste_rel_ingrediente_id.substr(id_deste_rel_ingrediente_id.lastIndexOf("r")+1, id_deste_rel_ingrediente_id.length);
	
					$.ajax({
				        url: 'php/crud_prato.php?atualizar_ingrediente=0&prato_id='+prato_id+'&ingrediente_id='+ingrediente_id+'&quantidade='+quantidade+"&rel_prato_ingrediente_id="+rel_prato_ingrediente_id,  //Server script to process data
				        type: 'GET',
				        dataType:'json',
				        success: function(data){
				        	
				        },
				        cache: false,
				        contentType: false,
				        processData: false
				    });
				}	
				window.location.replace("cadastro_prato.php");
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

function alterar_imagem_ingrediente(ingrediente_id,img_ingrediente){
	$.ajax({
	  type: "GET",
	  url: 'json/listar_ingredientes.php?ingrediente_id='+ingrediente_id,
	  dataType: "json",
	  success: function(data){

	  	$(img_ingrediente).css({
		    'background-image': 'url('+data.caminho_imagem+')',
		    'transition': 'background 500ms ease'
		});
	  }
	});
}





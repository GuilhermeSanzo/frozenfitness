$(document).ready(function(){
	jQuery(function($){
		$("#txtCep").mask("00000-000");
		
	});

	$("#txtCep").on("keyup",function(){
		
		var cep = $(this).val();	
		if(cep.length == 9){
			cep_sem = cep.replace("-","");
			
			$.ajax({
				url:"https://viacep.com.br/ws/"+cep_sem+"/json/",
				dataType:"json",
				success:function(data){

					var logradouro = data.logradouro;
					var nome_rua = data.logradouro;
					logradouro = logradouro.substr(0, logradouro.indexOf(" "));
					nome_rua = nome_rua.replace(logradouro+" ","");

					logradouro = "<option value='"+logradouro+"'>"+logradouro+"</option>";
					var HTML = '<option value="">---</option>'+
					'<option value="Rua">Rua</option>'+
	                '<option value="Avenida">Avenida</option>'+
	                '<option value="Alameda">Alameda</option>'+
	                '<option value="Estrada">Estrada</option>'+
	                '<option value="Rodovia">Rodovia</option>'+
	                '<option value="Quilômetro">Quilômetro</option>'+
	                '<option value="Outro">Outro</option>';

	                HTML = logradouro + HTML;


					$('#cboLogradouro').html(HTML);
					$('#txtNome').val(nome_rua);
					$("#txtNumero").focus();
					$('#txtBairro').val(data.bairro);
					$('#txtCidade').val(data.localidade);
					$('#txtEstado').val(data.uf);

				},
			});
		}

	});
});
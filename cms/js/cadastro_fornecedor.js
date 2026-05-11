$(document).ready(function(){
	jQuery(function($){
		$("#txtCnpj").mask('00.000.000/0000-00', {reverse: true});
		$("#txtCep").mask("00000-000");
	});
});
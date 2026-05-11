$(document).ready(function(){

	var prato_id = $("#prato_id").text();

	setTimeout(function(){
		contarVisualizacao(prato_id)
	},3000);
});

function contarVisualizacao(prato_id){
	$.ajax({
		url:'json/pontuar_view_prato.php?prato_id='+prato_id,
		success:function(data){

		},
	});
}
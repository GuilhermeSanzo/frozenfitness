

$(document).ready(function(){


	$("#btn_cadastrar").on( "mouseenter", function(){
		$(this).css({
		    'background-color': '#fff',
		    'color':'#000',
		    'transition': 'background 500ms ease'
		});
	});

	$("#btn_cadastrar").on( "mouseleave", function(){
		$(this).css({
		    'background-color': 'transparent',
		    'color':'#fff',
		    'transition': 'background 500ms ease'
		});
	});




	$(".box_button_login").on( "mouseenter", function(){
		$(this).animate({
		    'opacity': '1',
		},300);
	});

	$(".box_button_login").on( "mouseleave", function(){
		$(this).animate({
		    'opacity': '0.6',
		},300);
	});
});
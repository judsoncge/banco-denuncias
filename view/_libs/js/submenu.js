$(document).ready(function(){
	$(".servidores-subitem").hide(500);
	
	$(".denuncias-subitem").hide(500);
		
	$("#servidores").click(function(){
		$(".servidores-subitem").slideToggle();
	});
	
	$("#denuncias").click(function(){
		$(".denuncias-subitem").slideToggle();
	});
	
	
});
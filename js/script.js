$(document).ready(function() {
	$(".det").hide();

	$(".main").mouseover(function(){
		$(this).find(".det").show();
	});

	$(".main").mouseout(function(){
		$(this).find(".det").hide();
	});
});
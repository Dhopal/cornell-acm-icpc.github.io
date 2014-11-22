$(document).ready(function() {
	$(".det").hide();

	$("#about_nav").mouseover(function(){
		$("#about_det").show();
	});

	$("#about_nav").mouseout(function(){
		$("#about_det").hide();
	});
});
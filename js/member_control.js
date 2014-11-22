$(document).ready(function() {
	$(".group .contentArea").hide();

	$(".group").click(function(){
		$(".group .contentArea").hide();
		$(this).find(".contentArea").show();
	});

	$(".group").dblclick(function(){
		$(this).find(".contentArea").hide();
	});

	$("#seniorButton").click(function(){
		$("#seniors").trigger("click");
	});
	$("#seniorButton").click(function(){
		$("#juniors").trigger("click");
	});
	$("#sophButton").click(function(){
		$("#sophomores").trigger("click");
	});
	$("#freshButton").click(function(){
		$("#freshmen").trigger("click");
	});
});
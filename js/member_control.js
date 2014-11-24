$(document).ready(function() {
	$(".group .contentArea").hide();

	$(".group").click(function(){
		$content = $(this).find(".contentArea");
		$visible = $content.is(':visible');
		$(".group .contentArea").hide();
		if ($visible) {
			$content.hide();	
		}
		else {
			$content.show();
		}
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
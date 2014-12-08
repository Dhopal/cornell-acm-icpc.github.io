$(document).ready(function() {
	$(".group").click(function(){
		$content = $(this).find(".contentArea");
		/*$visible = $content.is(':visible');
		$(".group .contentArea").hide();
		if ($visible) {
			$content.hide();	
		}
		else {
			$content.show();
		}*/
	});
	$("#coachButton").click(function(){
		$("#coaches").trigger("click");
	});
	$("#seniorButton").click(function(){
		$("#seniors").trigger("click");
	});
	$("#juniorButton").click(function(){
		$("#juniors").trigger("click");
	});
	$("#sophButton").click(function(){
		$("#sophomores").trigger("click");
	});
	$("#freshButton").click(function(){
		$("#freshmen").trigger("click");
	});
});
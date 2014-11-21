$(document).ready(function(){
  $("#links a").click(function() {
    $(this).siblings().css("border", "none");
    $(this).css("border", "thick solid white" );
})
});


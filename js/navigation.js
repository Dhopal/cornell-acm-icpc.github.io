$(document).ready(function(){

  $("#links a").click(function() {
  
  // Set the clicked one.
  $(this).style.border = "thick solid  #ffffff";

  // Unset the others.
  ($(this).siblings()).style.border = "none";
})

});


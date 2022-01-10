$(function() {
  $(".card").hover(function(){
    $(this).fadeTo("5000",0.5); 
  },function(){
    $(this).fadeTo("6000",1.0);
  });
});
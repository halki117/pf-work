$(function(){
  
  $(".fade-img img:not(:first-child)").hide();
  setInterval(function() {
    $(".fade-img img:first-child").fadeOut("slow").next("img").fadeIn("slow").end().appendTo(".fade-img");
  },5000);
});
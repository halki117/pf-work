$(function() {
  $('[name="btn1"]:radio').change( function() {
    if($('[id=a]').prop('checked')){
      $('.text1').fadeOut();
      $('.text1-1').fadeIn();
    } else if ($('[id=b]').prop('checked')) {
      $('.text1').fadeOut();
      $('.text1-2').fadeIn();
    } 
  });

  $('[name="btn2"]:radio').change( function() {
    if($('[id=c]').prop('checked')){
      $('.text2').fadeOut();
      $('.text2-1').fadeIn();
    } else if ($('[id=d]').prop('checked')) {
      $('.text2').fadeOut();
      $('.text2-2').fadeIn();
    } 
  });
});
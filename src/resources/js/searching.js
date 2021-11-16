$(function() {
  $('[name="btn"]:radio').change( function() {
    if($('[id=a]').prop('checked')){
      $('.text').fadeOut();
      $('.text01').fadeIn();
    } else if ($('[id=b]').prop('checked')) {
      $('.text').fadeOut();
      $('.text02').fadeIn();
    } 
  });
});
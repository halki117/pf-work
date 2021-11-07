$(function(){
  $('#image').change(function(){
    if ( !this.files.length ) {
      return;
    }
    $('#preview').text('');
 
    var $files = $(this).prop('files');
    var len = $files.length;
    for ( var i = 0; i < len; i++ ) {
      var file = $files[i];
      var fr = new FileReader();
 
      fr.onload = function(e) {
        var src = e.target.result;
        var img = '<div class="img"><img src="'+ src +'"></div>';
        $('#preview').append(img);
      }
 
      fr.readAsDataURL(file);
    }
 
    $('#preview').css('display','block');
  });
});
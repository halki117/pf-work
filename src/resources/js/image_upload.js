$(function(){
  // スポット投稿機能の処理
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
    
    if(len > 3){
      alert("アップロード可能な画像は3枚までです");
      $('#spots_upload').prop('disabled', true);
    }
 
    $('#preview').css('display','block');
  });


  // ユーザー情報編集の処理
  $('#profile_photo__input').change(function(e){
    var file = e.target.files[0];
    var reader = new FileReader();

    if(file.type.indexOf("image") < 0){
      alert("画像ファイルを指定してください");
      return false;
    }

      reader.onload = function(e){
        $('#profile_photo').empty();
        var src = e.target.result;
        var img = '<div class="img"><img  class="profile_img" src="'+ src +'"></div>';
        $('#profile_photo').append(img);
      }
  
    reader.readAsDataURL(file);

  });
});
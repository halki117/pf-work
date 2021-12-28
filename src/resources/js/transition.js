$(function(){
  TransitionToTagPage();

  console.log('good');
  
  
  function TransitionToTagPage(){
    console.log('initial');
  
    $('.JS_Click_TransitionToTagPage').click(function(e){
      console.log('ok');
  
      // 伝播をストップ
      e.stopPropagation();
      e.preventDefault();
  
      // URLを取得して飛ばす
      location.href = $(this).attr('data-url');
    });
  }
});

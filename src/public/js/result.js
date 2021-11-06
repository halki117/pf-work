function initMap() {
  //地図を表示する領域の div 要素のオブジェクトを変数に代入
  var target = document.getElementById('map');  
  //HTMLに記載されている住所の取得
  var place = document.getElementById('place').textContent; 
  //ジオコーディングのインスタンスの生成
  var geocoder = new google.maps.Geocoder();  
  
  //geocoder.geocode() にアドレスを渡して、コールバック関数を記述して処理
  geocoder.geocode({ address: place }, function(results, status){
  //ステータスが OK で results[0] が存在すれば、地図を生成
     if (status === 'OK' && results[0]){  
        new google.maps.Map(target, {
        //results[0].geometry.location に緯度・経度のオブジェクトが入っている
          center: results[0].geometry.location,
          zoom: 14
        });
     }else{ 
     //ステータスが OK 以外の場合や results[0] が存在しなければ、アラートを表示して処理を中断
       alert('失敗しました。理由: ' + status);
       return;
     }
  });
}
// function initMap() {
//   //地図を表示する領域の div 要素のオブジェクトを変数に代入
//   var target = document.getElementById('map');  
//   //HTMLに記載されている住所の取得
//   var place = document.getElementById('place').textContent; 
//   //ジオコーディングのインスタンスの生成
//   var geocoder = new google.maps.Geocoder();  
  
//   //geocoder.geocode() にアドレスを渡して、コールバック関数を記述して処理
//   geocoder.geocode({ address: place }, function(results, status){

//     console.log(results[0].geometry.location);

//   //ステータスが OK で results[0] が存在すれば、地図を生成
//      if (status === 'OK' && results[0]){  
//         var map = new google.maps.Map(target, {
//         //results[0].geometry.location に緯度・経度のオブジェクトが入っている
//           center: results[0].geometry.location,
//           zoom: 14
//         });

//         var marker = new google.maps.Marker({
//           position: results[0].geometry.location,
//           map: map,
//           animation: google.maps.Animation.DROP
//         });

//         //情報ウィンドウの生成
//         var infoWindow = new google.maps.InfoWindow({
//           content: 'Hello!',
//           pixelOffset: new google.maps.Size(0, 5)
//         });
 
//        //マーカーにリスナーを設定
//        marker.addListener('click', function(){
//           infoWindow.open(map, marker);
//         });
        
//      }else{ 
//      //ステータスが OK 以外の場合や results[0] が存在しなければ、アラートを表示して処理を中断
//        alert('失敗しました。理由: ' + status);
//        return;
//      }
//   });

// }



// 名称から場所を検索特定する
      var map;
      var marker;
      var infoWindow;

      function initMap() {

        //マップ初期表示の位置設定
        var target = document.getElementById('target');

        // 緯度経度を大阪城に設定
        var centerp = {lat: 34.6880646, lng: 135.5229526};

        //マップ表示
        map = new google.maps.Map(target, {
          center: centerp,
          zoom: 13,
        });

        // 検索実行ボタンが押下されたとき
        document.getElementById('search').addEventListener('click', function() {

          var place = document.getElementById('keyword').value;
          var geocoder = new google.maps.Geocoder();      // geocoderのコンストラクタ

          geocoder.geocode({
            address: place
          }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {

              var bounds = new google.maps.LatLngBounds();

              for (var i in results) {
                if (results[0].geometry) {
                  // 緯度経度を取得
                  var latlng = results[0].geometry.location;
                  console.log(latlng.lat());
                  console.log(latlng.lng());
                  // 住所を取得
                  var address = results[0].formatted_address;
                  console.log(address);
                  // 検索結果地が含まれるように範囲を拡大
                  bounds.extend(latlng);
                  // マーカーのセット
                  setMarker(latlng);
                  // マーカーへの吹き出しの追加
                  setInfoW(place, latlng, address);
                  // マーカーにクリックイベントを追加
                  markerEvent();

                  document.getElementById('input_address').value = address;
                  document.getElementById('input_latitude').value = latlng.lat();
                  document.getElementById('input_longitude').value = latlng.lng();
                }
              }
            } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
              alert("見つかりません");
            } else {
              console.log(status);
              alert("エラー発生");
            }
          });

        });

        // 結果クリアーボタン押下時
        document.getElementById('clear').addEventListener('click', function() {
          deleteMakers();
        });

      }

      // マーカーのセットを実施する
      function setMarker(setplace) {
        // 既にあるマーカーを削除
        deleteMakers();

        var iconUrl = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
          marker = new google.maps.Marker({
            position: setplace,
            map: map,
            icon: iconUrl
          });
        }

        //マーカーを削除する
        function deleteMakers() {
          if(marker != null){
            marker.setMap(null);
          }
          marker = null;
        }

        // マーカーへの吹き出しの追加
        function setInfoW(place, latlng, address) {
          infoWindow = new google.maps.InfoWindow({
          content: "<a href='http://www.google.com/search?q=" + place + "' target='_blank'>" + place + "</a><br><br>" + latlng + "<br><br>" + address + "<br><br><a href='http://www.google.com/search?q=" + place + "&tbm=isch' target='_blank'>画像検索 by google</a>"
        });
      }

      // クリックイベント
      function markerEvent() {
        marker.addListener('click', function() {
          infoWindow.open(map, marker);
        });
      }









// // リーバースジオコーディング

// function initMap() {
//   var target = document.getElementById('gmap');  
//   //マップを生成
//   var map = new google.maps.Map(target, {  
//     center: {lat: 40.748441, lng: -73.985664},
//     zoom: 14
//   });
//   //ジオコーディングのインスタンスの生成
//   var geocoder = new google.maps.Geocoder();  
  
//   //マップにリスナーを設定
//   map.addListener('click', function(e){

//     //リバースジオコーディングでは location を指定
//     geocoder.geocode({location: e.latLng}, function(results, status){

//       // result（レスポンス）をコンソールに表示している
//       console.log(results[0].formatted_address);

//       // 緯度、経度をコンソールに表示している
//       console.log(results[0].geometry.location.lat());
//       console.log(results[0].geometry.location.lng());

//       if(status === 'OK' && results[0]) {
//         //マーカーの生成
//         var marker = new google.maps.Marker({
//           position: e.latLng,
//           map: map,
//           title: results[0].formatted_address,
//           animation: google.maps.Animation.DROP
//         });
        
//         //情報ウィンドウの生成
//         var infoWindow = new google.maps.InfoWindow({
//           content:  results[0].formatted_address,
//           pixelOffset: new google.maps.Size(0, 5)
//         });
 
//         //マーカーにリスナーを設定
//         marker.addListener('click', function(){
//           infoWindow.open(map, marker);
//         });
        
//         //情報ウィンドウリスナーを設定
//         infoWindow.addListener('closeclick', function(){
//           marker.setMap(null);  //マーカーを削除
//         });
//       }else if(status === 'ZERO_RESULTS') {
//         alert('不明なアドレスです： ' + status);
//         return;
//       }else{
//         alert('失敗しました： ' + status);
//         return;
//       }
//     });
//   });
// } 
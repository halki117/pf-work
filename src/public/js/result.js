
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

        // マップをクリックすることによって細かな座標を指定できる
        map.addListener('click', function(e) {
          clickMap(e.latLng, map);
        });

        function clickMap(geo, map) {
          
          lat = geo.lat();
          lng = geo.lng();
          
          //小数点以下6桁に丸める場合
          //lat = Math.floor(lat * 1000000) / 1000000);
          //lng = Math.floor(lng * 1000000) / 1000000);
          
          document.getElementById('input_latitude').value = lat;
          document.getElementById('input_longitude').value = lng;

          //中心にスクロール
          map.panTo(geo);
          
          //マーカーの更新
          deleteMakers();
          marker = new google.maps.Marker({
            map: map, position: geo 
          });

          var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'latLng': geo}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    for (var i in results) {
                      document.getElementById('result_address').textContent = (results[0].formatted_address);
                      document.getElementById('input_address').value = (results[0].formatted_address);
                    }
                    
                }
                else {
                    window.alert("google.maps.GeocoderStatus is not OK. due to " + status);
                }
            });
        }



        // 検索実行ボタンが押下されたときの処理、住所から座標を割り出しマップ城にマーキングする
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
                  //中心にスクロール
                  map.panTo(latlng);
                  // マーカーへの吹き出しの追加
                  setInfoW(place, latlng, address);
                  // マーカーにクリックイベントを追加
                  markerEvent();

                  
                  if(!!document.getElementById('input_address')){
                    document.getElementById('input_address').value = address
                  }
                  // document.getElementById('input_address').value = address;
                  document.getElementById('input_latitude').value = latlng.lat();
                  document.getElementById('input_longitude').value = latlng.lng();

                  document.getElementById('result_address').textContent = (results[0].formatted_address);
                  if(!!document.getElementById('result_address')){
                    document.getElementById('result_address').textContent = address
                  }
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
          document.getElementById('input_address').value = '';
          document.getElementById('keyword').value = '';
          document.getElementById('result_address').textContent = '';
        });

      }



      // 細かな処理を関数にまとめた 

      // マーカーのセットを実施する
      function setMarker(setplace) {
        console.log('ok');
        // 既にあるマーカーを削除
        deleteMakers();

        var iconUrl = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
          marker = new google.maps.Marker({
            position: setplace,
            map: map,
            icon: iconUrl,
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
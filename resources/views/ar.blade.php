<!DOCTYPE html>
<html lang="ja">

<head>
 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel-AR</title>
  <link rel="stylesheet" href="./css/gs-yonde.css">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> 
  <script src="//aframe.io/releases/0.8.0/aframe.min.js"></script>
  <script src="//jeromeetienne.github.io/AR.js/aframe/build/aframe-ar.js"></script>
  <script src="https://rawgit.com/jeromeetienne/AR.js/master/aframe/build/aframe- ar.js"></script> 
  <!-- events.js ライブラリの読み込み-->
  <script>
    src="https://rawgit.com/nicolocarpignoli/nicolocarpignoli.github.io/master/ar-click-events/events.js"></script>

  <!-- aframe-extras読み込み -->
  <script src="https://cdn.rawgit.com/donmccurdy/aframe-extras/v4.2.0/dist/aframe-extras.min.js"></script>

  <!-- 3d文字ライブラリー -->
  <script
    src="https://rawgit.com/ngokevin/kframe/master/components/text-geometry/dist/aframe-text-geometry-component.js"></script>
  <!-- aframe ライブラリ -->
  <script
    src="https://rawgit.com/mayognaise/aframe-mouse-cursor-component/master/dist/aframe-mouse-cursor-component.js"></script>




  <script>
    AFRAME.registerComponent('registerevents', {
      init: function () {
        var marker = this.el;

        // マーカー検出時
        marker.addEventListener('markerFound', function () {
          var markerId = marker.id;

          var found = document.querySelector('#found');
          document.getElementById("hold_over_marker").style.display = 'none';
        });

        // マーカー見失った時
        marker.addEventListener('markerLost', function () {
          var markerId = marker.id;

          var found = document.querySelector('#found');
          document.getElementById("hold_over_marker").style.display = 'block';
        });
      }
    });


    AFRAME.registerComponent('vidhandler', {
      init: function () {
        this.toggle = false;
        this.vid = document.querySelector("#vid");
        this.vid.pause();
      },
      tick: function () {
        if (this.el.object3D.visible == true) {
          if (!this.toggle) {
            this.toggle = true;
            this.vid.play();
          }
        } else {
          this.toggle = false;
          this.vid.pause();
        }
      }
    });

    function refrespage() {
      location.reload();
    }

    function playvid() {
      vid.play();
    }

  </script>
</head>

<body style="margin : 0px; overflow: hidden;">
  
  <a-scene embedded
    artoolkit="sourceType: webcam; detectionMode: mono; maxDetectionRate: 60; canvasWidth: 200; canvasHeight: 200"
    arjs="debugUIEnabled: false;" vr-mode-ui="enabled: false">

    <a-assets>
      <video preload="auto" id="vid" poster="" response-type="arraybuffer" loop="true" crossorigin webkit-playsinline
        playsinline controls>
        <source src="./img/gsbase.mp4">

      </video>
    </a-assets>

    <!-- bus -->
    <a-assets>
      <a-asset-item id="bus" src="./model/busLoop4.gltf"></a-asset-item>
    </a-assets>

    <a-marker id="found" type="pattern" url="./img/pattern-marker.patt" begin="markerfound" end="markerlost"
      registerevents vidhandler>

      <!-- video -->
      <a-entity>
        <a-plane position="0 1.6 -1.8" rotation="-30 0 -1" scale="3 2 2" material=" transparent:true;src:#vid" controls>
        </a-plane>
      </a-entity>

      <!-- bus -->
      <a-entity gltf-model="#bus" position="0 0 0" scale="0.3 0.3 0.3" rotation="-10 0 0" animation-mixer
        shadow="receive: true">
      </a-entity>

  
      <!-- letter -->
      <a-entity id="arlink" position="-1.2 0.7 1.3" rotation="-30 0 0"
        text-geometry="value:; bevelEnabled: true; bevelSize: 0.016; bevelThickness: 0.016; size: 0.25;"
        material="color: #70008D;"></a-entity>
    </a-marker>

    <a-entity camera></a-entity>

  </a-scene>

  <!-- 画面右上のアイコン -->
  <div class="info">
    <a href=""><img class="info_img" src="./img/questionnaire.png" alt=""></a>
    <a href="https://twitter.com/gsfukuoka"><img class="info_img" src="./img/twitter.png" alt=""></a>
    <a href="https://www.facebook.com/gsfukuoka/"><img class="info_img" src="./img/facebook.png" alt=""></a>
  </div>

  <!-- 文字 -->
  <div id="hold_over_marker">
    <div class="hand">
      <img src="./img/hand.png" alt="">
    </div>
    ARマーカーにかざして下さい
  </div>

  <!-- カメラ機能 ------------------------------------->
  <div class="ui">

    <div class="none" id="modal">
      <p class="close disabled" id="delete-photo"><img src="./img/x-mark.png" alt=""></p>
      <div class="hozon">
        <a href="#" id="download-photo" download="selfie.png" title="Save Photo" class="disabled save"
          target="_blank"><i class="fas fa-cloud-download-alt"></i> 写真を保存
        </a>
      </div>
      </div>
      <a href="http://localhost/question" > アンケートお願いします。</a>
      <img id="snap">
    </div>
      <img id="snap">
    </div>

    <a href="" class="totte" id="take-photo" title="Take Photo"><img src="./img/shutter.png" alt=""></a>

   
  </div>

  <!-- video -->
  <div class="footer">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-left">
        <div class="onebleft">
          <button onclick="vid.playvid()" class="btn btnskips">Play (CHROME)</button>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right">
        <div class="onebright">
          <button onclick="refrespage()" class="btn btnskips">Refresh</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="./js/gs-yonde.js"></script>
</body>

</html>


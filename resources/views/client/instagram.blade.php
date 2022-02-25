<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Instagram results</title>
  	
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/instagram.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
<header>
    <div class="top_header">
        <img src="{{ asset('img/Yonde.png') }}" id="logo">
        <!-- ログアウト -->
        <form method="POST" action="{{ route('logout')}}"> 
          @csrf
          <input type="hidden" name="project_id" value="{{$project_id}}">
          <button type="submit"><i class="bi bi-door-open" id="logout_icon"></i></button>
        </form>
        <!-- プロジェクト一覧 -->
        <a href="{{ route('client.projects')}}" method="GET"><i class="bi bi-grid-fill" id="projects_icon"></i></a>
    </div>
    <div class="left_header">
      <a href="{{route('client.survey', ['project_id'=>$project_id])}}">
        <i class="bi bi-clipboard-data off" id="survey_icon"></i>
      </a>
      <i class="bi bi-instagram on" id="instagram_icon"></i>
      <div class="jumplink">
        <a href="#hushtag"> 一緒に使われるハッシュタグ</a>
        <a href="#table_s"> 投稿文によく使われる言葉</a>
      </div>
    </div>
</header>


<form method="POST" action="{{ route('client.survey')}}"> 
    @csrf
    <input type="hidden" name="project_id" value="{{$project_id}}">
    <button type="submit">link for survey</button>
</form>

<main>
<div id="main">
  <h1 id="hushtag"># {{$hushtag->hushtag}}</h1>
  <p id="data_len">取得した投稿数：{{$data_len}}</p>
  
  <!-- データがある場合 -->
  <?php if($hushtag_output):?>
  <!-- ハッシュタグの結果 -->
  <div id="table_f">
    <h2 class="title" >一緒に使われるハッシュタグ</h2>

    <table class="table">
      <thead>
      <tr>
        <th class="table_head_f bg-head">ハッシュタグ</th>
        <th class="table_head_f bg-head" id="table_head_f">ハッシュタグ</th>
      </tr>
      </thead>
      <tbody> 
        <?php for ($i=0; $i<=24; $i++) { ?>
        <tr>
          <th class="table-left">{{$i*2+1}}</th>
          <td class="table_content_f"># {{ $hushtag_output[$i*2][0]}}</td>
          <td class="table_times_f">{{ $hushtag_output[$i*2][1]}}回</td>
          <th class="table-left">{{$i*2+2}}</th>
          <td class="table_content_f"># {{ $hushtag_output[$i*2+1][0]}}</td>
          <td class="table_times_f">{{ $hushtag_output[$i*2+1][1]}}回</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>


  <!-- 投稿文の結果 -->
  <div id=table_s>
    <h2 class="title">投稿文によく使われる言葉</h2>
    <table class="table">
      <thead>
      <tr>
        <th class="table-left bg-head"></th>
        <th  colspan="2" class="table_head_s bg-head">名詞</th>
        <th  colspan="2" class="table_head_s bg-head">形容詞</th>
        <th  colspan="2" class="table_head_s bg-head">動詞</th>
      </tr>
      </thead>
      <tbody> 
        <div class="scroll">
          <?php for ($i=0; $i<=49; $i++) { ?>
          <tr>
            <th class="table-left">{{$i+1}}</th>
            <td class="table_content_s">{{ $norn_output[$i][0]}}</td>
            <td class="table_times_s">{{ $norn_output[$i][1]}}回</td>
            <td class="table_content_s">{{ $adjective_output[$i][0]}}</td>
            <td class="table_times_s">{{ $adjective_output[$i][1]}}回</td>
            <td class="table_content_s">{{ $verb_output[$i][0]}}</td>
            <td class="table_times_s">{{ $verb_output[$i][1]}}回</td>
          </tr>
        <?php } ?>
        </div>
      </tbody>
    </table>
  </div>
  <!-- データがない場合 -->
  <?php else:?>
    <h1 id="alert">データがありません<h1>
  <?php endif; ?>
</div>
</main>
<!-- APIを強制実行するためのリンク（通常時は使用しない） -->
<!-- <a href="{{route('client.api_test')}}" id="test_api">test_api</a> -->
</body>
</html>

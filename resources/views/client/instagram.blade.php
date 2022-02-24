<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Instagram results</title>
  	
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/instagram.css') }}">
<link rel="stylesheet" href="{{asset('/css/project_analysis.css')}}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
<header>
    <div class="hamburger-menu">
        <input type="checkbox" id="menu-btn-check">
        <label for="menu-btn-check" class="menu-btn"><span></span></label>
        <!--ここからメニュー-->
        <div class="menu-content">
          <h1>Project Deta Analysis</h1>
            <ul>
                <li>
                    <a href="/instagram">Instagram(This page)</a>
                </li>
                <li>
                    <a href="/survey">Survey</a>
                </li>
                <li>
                    <a href="/project_analysis">Top</a>
                </li>
            </ul>
        </div>
        <!--ここまでメニュー-->
    </div>

</header>


<form method="POST" action="{{ route('client.survey')}}"> 
    @csrf
    <input type="hidden" name="project_id" value="{{$project_id}}">
    <button type="submit">link for survey</button>
</form>

<main>
<div id="main">
  <h1 id="hushtag">#{{$hushtag->hushtag}}</h1>
  <p id="data_len">取得した投稿数：{{$data_len}}</p>
  
  <!-- データがある場合 -->
  <?php if($hushtag_output):?>
  <!-- ハッシュタグの結果 -->
  <div id="table_f">
    <h2 class="title">一緒に使われるハッシュタグ</h2>

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

<a href="{{route('client.api_test')}}">test_api</a>
<a href="{{route('client.analyze')}}">run_analyze</a>
</body>
</html>

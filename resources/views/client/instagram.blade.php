<x-app-layout>
    <x-slot name="header"></x-slot>
    <link rel="stylesheet" href="{{ asset('css/instagram.css') }}">
    <!-- アンケート分析結果を表示するためのリンク（セキュリティの都合上postで送信） -->
    <form method="POST" action="{{ route('client.survey')}}">  
        @csrf
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <button type="submit">link for survey</button>
    </form>

    <div id="table">

      <h4>取得した投稿数：{{$data_len}}</h4>

      <!-- ハッシュタグの結果 -->
      <table class="table">
        <thead>
        <tr>
          <th></th>
          <th>ハッシュタグ</th>
          <th>出現回数</th>
        </tr>
        </thead>
        <tbody> 
          <?php for ($i=0; $i<=24; $i++) { ?>
          <tr>
            <th>{{$i*2+1}}</th>
            <td>{{ $hushtag_output[$i*2][0]}}</td>
            <td>{{ $hushtag_output[$i*2][1]}}回</td>
            <th>{{$i*2+2}}</th>
            <td>{{ $hushtag_output[$i*2+1][0]}}</td>
            <td>{{ $hushtag_output[$i*2+1][1]}}回</td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <!-- 投稿文の結果 -->
      <table class="table">
        <thead>
        <tr>
          <th></th>
          <th>名詞</th>
          <th></th>
          <th>形容詞</th>
          <th></th>
          <th>動詞</th>
          <th></th>
        </tr>
        </thead>
        <tbody> 
          <?php for ($i=0; $i<=49; $i++) { ?>
          <tr>
            <th>{{$i}}</th>
            <td>{{ $norn_output[$i][0]}}</td>
            <td>{{ $norn_output[$i][1]}}</td>
            <td>{{ $adjective_output[$i][0]}}</td>
            <td>{{ $adjective_output[$i][1]}}</td>
            <td>{{ $verb_output[$i][0]}}</td>
            <td>{{ $verb_output[$i][1]}}</td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <a href="{{route('client.api_test')}}">test_api</a>
    <a href="{{route('client.analyze')}}">run_analyze</a>
</x-app-layout>

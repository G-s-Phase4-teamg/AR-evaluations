<x-app-layout>
    <x-slot name="header"></x-slot>
    <p>{{ $hushtags}}</p>
    <!-- アンケート分析結果を表示するためのリンク（セキュリティの都合上postで送信） -->
    <form method="POST" action="{{ route('client.survey')}}">  
        @csrf
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <button type="submit">link for survey</button>
    </form> 
    <a href="{{route('client.api_test')}}">test_api</a>
    <a href="{{route('client.analyze')}}">run_analyze</a>
    @foreach($hushtag_output as $h)
      <p>#{{ $h[0]}}：{{ $h[1]}}</p>
    @endforeach
    @foreach($verb_output as $v)
      <p>{{ $v[0]}}：{{ $v[1]}}</p>
    @endforeach
    @foreach($adjective_output as $a)
      <p>{{ $a[0]}}：{{ $a[1]}}</p>
    @endforeach
</x-app-layout>
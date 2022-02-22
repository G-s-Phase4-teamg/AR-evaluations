<x-app-layout>
    <x-slot name="header"></x-slot>
    <p>{{ $hushtags}}</p>
    <!-- アンケート分析結果を表示するためのリンク（セキュリティの都合上postで送信） -->
    <form method="POST" action="{{ route('client.survey')}}">  
        @csrf
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <button type="submit">link for survey</button>
    </form> 
</x-app-layout>
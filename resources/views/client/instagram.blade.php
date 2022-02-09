<x-app-layout>
    <x-slot name="header"></x-slot>
    <p>{{ $hushtags}}</p>
    <form method="POST" action="{{ route('client.survey')}}"> 
        @csrf
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <button type="submit">link for survey</button>
    </form> 
</x-app-layout>
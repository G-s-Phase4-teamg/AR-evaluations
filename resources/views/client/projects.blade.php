<x-app-layout>
    <x-slot name="header"></x-slot>
@foreach ($projects as $project)
    <p>{{$project}}</p>
    <form method="POST" action="{{ route('client.survey')}}"> 
        @csrf
        <input type="hidden" name="project_id" value="{{$project->id}}">
        <button type="submit">link</button>
    </form> 
@endforeach
</x-app-layout>
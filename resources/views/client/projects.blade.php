<x-app-layout>
    <x-slot name="header"></x-slot>
@foreach ($projects as $project)
    <p>{{$project}}</p>
    <a href="{{ route('client.survey') }}">link</a>
@endforeach;
</x-app-layout>
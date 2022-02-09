@foreach ($projects as $project)
    <p>{{$project}}</p>
    <a href="{{ route('client.survey') }}">link</a>
@endforeach;
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>yonde_project</title>
	
<link rel="stylesheet" href="{{asset('/css/yonde_project.css')}}">
</head>
<body>
@foreach ($projects as $project)
    <p>{{$project}}</p>
    <!-- アンケート分析結果を表示するためのリンク（セキュリティの都合上postで送信） -->
    <form method="POST" action="{{ route('client.survey')}}"> 
        @csrf
        <input type="hidden" name="project_id" value="{{$project->id}}">
        <button type="submit">link</button>
    </form> 
@endforeach

<div class="wrapper tabled container">
  <div class="stage" id="page1">
    <div class="middled">

      <h2 class="title">Yonde project list</h2>
      <h4>choose your project!</h4>

      <div class="container">
        @foreach($projects as $project)
        <div class="item link-1">
          <a href="/project_analysis">
            <span class="thin">{{$project->name}}</span>
          </a>
        <p>From {{$project->released_at}}</p>    
        </div>
        @endforeach
      </div>

    </div>
 
  </div>
</div>

</body>
</html>

© 2022 GitHub, Inc.

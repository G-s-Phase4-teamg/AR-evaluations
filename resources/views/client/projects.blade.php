<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>yonde_project</title>
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{asset('/css/yonde_project.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>
<header>
  <div class="top_header">
    <img src="{{ asset('img/Yonde.png') }}" id="logo">
    <!-- ログアウト -->
    <form method="POST" action="{{ route('logout')}}"> 
      @csrf
      <button id="unvisible_button" type="submit"><i class="bi bi-door-open" id="logout_icon" style="top:11px;"></i></button>
    </form>
</header>
<main>
  <div class="wrapper tabled container">
    <div class="stage" id="page1">
      <div class="middled">

        <h2 class="title">Yonde project list</h2>
        <h4>choose your project!</h4>

        <div class="container">
          @foreach($projects as $project)
          <div class="item link-1">
            <a href="{{route('client.survey', ['project_id'=>$project->id])}}">
              <span class="thin">{{$project->name}}</span>
            </a>
            <p>From {{$project->released_at}}</p>
          </div>
          @endforeach
        </div>

      </div>
  
    </div>
  </div>
</main>
</body>
</html>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無題ドキュメント</title>
  	
<link rel="stylesheet" href="{{asset('/css/project_analysis.css')}}">
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
                    <a href="/instagram">Instagram</a>
                </li>
                <li>
                    <a href="/survey">Survey（This page)</a>
                </li>
                <li>
                    <a href="/project_analysis">Top</a>
                </li>
            </ul>
        </div>
        <!--ここまでメニュー-->
    </div>

</header>
<main>

<div class="header">
  <h1>Survey Deta</h1>
  </div>
</main>

</body>
</html>


<x-app-layout>
    <x-slot name="header"></x-slot>
test_survey
<p>{{$questions}}</p>
<p>{{$choices}}</p>
<p>{{$choice_answers}}</p>
<p>{{$text_answers}}</p>

<form method="POST" action="{{ route('client.instagram')}}"> 
    @csrf
    <input type="hidden" name="project_id" value="{{$project_id}}">
    <button type="submit">link for instagram</button>
</form> 
</x-app-layout>
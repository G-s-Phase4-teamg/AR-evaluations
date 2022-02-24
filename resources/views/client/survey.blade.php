
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Survey results</title>
<!-- Styles -->
<!-- <link rel="stylesheet" href="{{asset('/css/project_analysis.css')}}"> -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/survey.css') }}">
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
</head>

<body>
<header>
    <div class="top_header">
    </div>
    <div class="left_header">
    </div>
</header>
<main>
    <h1 id="result_text">アンケート結果</h1>
    <p id="data_len">回答したユーザ数：{{$user_len}}</p>

    <!-- アンケート結果 -->
    <?php $count=0; $t_count=-1; $c_count=-1; $choices=json_encode($choice_output)?>
    @foreach($questions as $question)
    <div class="result">
        <!-- 選択式の回答 -->
        <?php $count=$count+1;?>
        <?php $q_type=""; if($question->type == 2){$q_type=" (複数選択)";}; ?>
        <h2 class="title">Q{{$count}}. {{$question->query}}{{$q_type}}</h2>
        <?php if($question->type == 1 || $question->type == 2) : $id=$question->id; $c_count=$c_count+1;?>
            <div class="canvas-container">
                <canvas id="<?=$id?>" ></canvas>
                <script>
                var ctx = document.getElementById("<?=$id?>");
                ctx.height = 350;
                ctx.width = "500px";
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: <?=$choices?>[<?=$c_count?>][1],
                        datasets: [{
                            backgroundColor: ["#2b70b6", "#e061c6", "#efd43e", "#26a61c", "#f89c2a", "#537750", "#e6a2e5", "#8f1936"],
                            data: <?=$choices?>[<?=$c_count?>][0]
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                display: true,
                                labels: {
                                    padding: 14,
                                    font: {
                                        size: 17,
                                    }
                                }
                            }
                        }
                    }
                });
                </script>
            </div>
        <!-- 文字入力式の回答 -->
        <?php elseif ($question->type == 3) : $t_count=$t_count+1; $texts=$text_output[$t_count];;?>
            <div class="text_box">
                @foreach($texts as $text)
                    <p class="text_answer">{{$text}}</p>
                @endforeach
            </div>
        <?php endif; ?>
    </div>
    @endforeach
</main>
    <!-- インスタ分析結果を表示するためのリンク（セキュリティの都合上postで送信） -->
    <form method="POST" action="{{ route('client.instagram')}}"> 
        @csrf
        <input type="hidden" name="project_id" value="{{$project_id}}">
        <button type="submit">link for instagram</button>
    </form> 
</body>
</html>
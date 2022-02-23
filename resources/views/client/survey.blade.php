<!doctype html>
<html>
<head>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/survey.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv@3.0.5/dist/chartjs-plugin-labels.min.js"></script>
</head>
<body>
    <main>
        <h1 id="hushtag">アンケート結果</h1>
        <p id="data_len">回答したユーザ数：</p>

        <!-- アンケート結果 -->
        <?php $count=0; $t_count=-1; $c_count=-1; $choices=json_encode($choice_output)?>
        @foreach($questions as $question)
        <div class="result">
            <!-- 選択式の回答 -->
            <?php $count=$count+1;?>
            <h2 class="title">Q{{$count}}. {{$question->query}}</h2>
            <?php if($question->type == 1) : $id=$question->id; $c_count=$c_count+1;?>
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
                                backgroundColor: ["#2b70b6", "#e061c6", "#efd43e", "#26a61c", "#2a1ca6", "#f89c2a", "#537750", "#e6a2e5", "#8f1936"],
                                data: <?=$choices?>[<?=$c_count?>][0]
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    labels: {
                                        fontColor: '#ff0000',
                                        fontSize: 18,
                                    },
                                    position: 'right',
                                    display: true,
                                }
                            },
                        }
                    });
                    </script>
                </div>
            <!-- 文字入力式の回答 -->
            <?php elseif ($question->type == 2) : $t_count=$t_count+1; $texts=$text_output[$t_count];;?>
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
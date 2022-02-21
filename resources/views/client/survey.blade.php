<x-app-layout>
<x-slot name="header"></x-slot>
<link rel="stylesheet" href="{{ asset('css/survey.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<?php $t_count=-1; $c_count=-1; $choices=json_encode($choice_output)?>
<body>
    @foreach($questions as $question)
    <div style="width:500px;">
    {{$question->query}}
    <?php if($question->type == 1) : $id=$question->id; $c_count=$c_count+1;?>
        <!-- 選択式の回答 -->
        <canvas id="<?=$id?>"></canvas>
        <script>
        var ctx = document.getElementById("<?=$id?>");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?=$choices?>[<?=$c_count?>][1],
                position: "right",
                datasets: [{
                    backgroundColor: ["#2b70b6", "#e061c6", "#efd43e", "#26a61c", "#2a1ca6", "#f89c2a", "#537750", "#e6a2e5", "#8f1936"],
                    data: <?=$choices?>[<?=$c_count?>][0]
                }]
            },
            options: {
                plugins: {
                    legend:{
                        position: 'right'
                    }
                },
            }
        });
        </script>
    <?php elseif ($question->type == 2) : $t_count=$t_count+1; $texts=$text_output[$t_count];;?>
        <div class="text">
            @foreach($texts as $text)
                <p>{{$text}}</p>
            @endforeach
        </div>
    <?php endif; ?>

    </div>
    @endforeach

<!-- インスタ分析結果を表示するためのリンク（セキュリティの都合上postで送信） -->
<form method="POST" action="{{ route('client.instagram')}}"> 
    @csrf
    <input type="hidden" name="project_id" value="{{$project_id}}">
    <button type="submit">link for instagram</button>
</form> 
</x-app-layout>
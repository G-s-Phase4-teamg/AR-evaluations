<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clientsテーブル
        DB::table("clients")->insert([
            "name" => "test_client",
            "mail_address" => "test@test",
            "password" => "password",
        ]);


        //usersテーブル
        $start = Carbon::create("2021", "1", "1"); //created_atの範囲を指定(スタート)
        $end = Carbon::create("2021", "1", "27"); //created_atの範囲を指定(エンド)
        $min = strtotime($start);//timestampに変換
        $max = strtotime($end);//timestampに変換
        for ($i =1; $i <=10; $i++){   //10個データを作成するためのループ
            $date = rand($min, $max); //ランダムに日付を指定
            $date = date('Y-m-d', $date);
            DB::table("users")->insert([
                "project_id" => 1,
                "created_at" => $date,
                "updated_at" => $date,
            ]);
        }

        //projectsテーブル
        DB::table("projects")->insert([
            "client_id" => 1,
            "ar_url" => "test_url",
            "public_url" => "test_public",
            "name" => "クリスマスイベント",
        ]);
        DB::table("projects")->insert([
            "client_id" => 1,
            "ar_url" => "test2_url",
            "public_url" => "test2_public",
            "name" => "バレンタインイベント",
        ]);

        //hushtagsテーブル
        DB::table("hushtags")->insert([
            "project_id" =>1,
            "hushtag" => "クリスマスtestAR",
        ]);

        //questionsテーブル
        DB::table("questions")->insert([
            "project_id" =>1,
            "type" => 1,
            "query" => "このイベントに満足していますか？",
            "priority_key"=>1,
        ]);
        DB::table("questions")->insert([
            "project_id" =>1,
            "type" => 2,
            "query" => "このイベントをどこで知りましたか？",
            "priority_key"=>2,
        ]);
        DB::table("questions")->insert([
            "project_id" =>1,
            "type" => 3,
            "query" => "使ったARの感想を教えてください。",
            "priority_key"=>3,
        ]);

        //choicesテーブル
        $choice_list=["非常に満足", "やや満足", "どちらともいえない", "やや不満", "非常に不満"]; //choiceに入れるリストを作成
        for ($i =0; $i <=4; $i++){   //5個データを作成するためのループ
            DB::table("choices")->insert([
                "question_id"=>1,
                "choice"=>$choice_list[$i],
                "priority_key" =>$i,
            ]);
        }
        $choice_list=["Webサイト", "チラシ", "インスタグラム", "ツイッター", "知らなかった"]; //choiceに入れるリストを作成
        for ($i =0; $i <=4; $i++){   //5個データを作成するためのループ
            DB::table("choices")->insert([
                "question_id"=>2,
                "choice"=>$choice_list[$i],
                "priority_key" =>$i,
            ]);
        }

        //choice_answersテーブル
        for ($i =1; $i <=10; $i++){   //10個データを作成するためのループ
            $rand_choice = rand(1, 5); //choice_idに入れるランダムな値を生成
            DB::table("choice_answers")->insert([
                "question_id"=>1,
                "choice_id"=>$rand_choice,
                "user_id"=>$i,
            ]);
            $rand_choice = rand(6, 10); //choice_idに入れるランダムな値を生成
            DB::table("choice_answers")->insert([
                "question_id"=>2,
                "choice_id"=>$rand_choice,
                "user_id"=>$i,
            ]);
        }

        //text_answersテーブル
        for ($i=1; $i <=10; $i++){
            DB::table("text_answers")->insert([
                "question_id"=> 3,
                "answer"=> Str::random(10),
                "user_id"=> $i,
            ]);
        }
    }
}

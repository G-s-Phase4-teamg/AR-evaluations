<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     // $this -> call("TableSeeder::class");
        
    // }

    public function run()
    {
        //usersテーブル
        $date=Carbon::create("2021", "2", "1"); //created_atの日付を指定
        $date=strtotime($date); //dateをtimestampに変換
        $date = date('Y-m-d', $date);
        DB::table("users")->insert([
            "name" => "test_client",
            "email" => "test@test",
            "password" => Hash::make("password"),
            "created_at" => $date,
            "updated_at" => $date,
        ]);


        //customersテーブル
        $start = Carbon::create("2021", "2", "1"); //created_atの範囲を指定(スタート)
        $end = Carbon::create("2021", "2", "27"); //created_atの範囲を指定(エンド)
        $min = strtotime($start);//timestampに変換
        $max = strtotime($end);//timestampに変換
        for ($i =1; $i <=30; $i++){   //10個データを作成するためのループ
            $date = rand($min, $max); //ランダムに日付を指定
            $date = date('Y-m-d', $date);
            DB::table("customers")->insert([
                "project_id" => 1,
                "created_at" => $date,
                "updated_at" => $date,
            ]);
        }

        //projectsテーブル
        DB::table("projects")->insert([
            "users_id" => 1,
            "ar_url" => "test_url",
            "public_url" => "test_public",
            "name" => "クリスマスイベント",
            "released_at" =>date('2021-12-1'),
            "closed_at" =>date('2021-12-26'),
        ]);
        DB::table("projects")->insert([
            "users_id" => 1,
            "ar_url" => "test2_url",
            "public_url" => "test2_public",
            "name" => "バレンタインイベント",
            "released_at" =>date('2022-2-1'),
            "closed_at" =>date('2022-2-28'),
        ]);
        DB::table("projects")->insert([
            "users_id" => 2,
            "ar_url" => "test3_url",
            "public_url" => "test3_public",
            "name" => "イベント",
            "released_at" =>date('2022-4-1'),
            "closed_at" =>date('2022-4-28'),
        ]);

        //hushtagsテーブル
        DB::table("hushtags")->insert([
            "project_id" =>1,
            "hushtag" => "バレンタイン",
            "hushtag_id" => "17841403181514482",
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
        for ($i =1; $i <=30; $i++){   //10個データを作成するためのループ
            $rand_choice = rand(1, 5); //choice_idに入れるランダムな値を生成
            DB::table("choice_answers")->insert([
                "question_id"=>1,
                "choice_id"=>$rand_choice,
                "customer_id"=>$i,
            ]);
            $rand_choice = rand(6, 10); //choice_idに入れるランダムな値を生成
            DB::table("choice_answers")->insert([
                "question_id"=>2,
                "choice_id"=>$rand_choice,
                "customer_id"=>$i,
            ]);
        }

        //text_answersテーブル
        for ($i=1; $i <=30; $i++){
            DB::table("text_answers")->insert([
                "question_id"=> 3,
                "answer"=> Str::random(10),
                "customer_id"=> $i,
            ]);
        }
    }
}

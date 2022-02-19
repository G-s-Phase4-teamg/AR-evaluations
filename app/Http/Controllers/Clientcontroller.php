<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Questions;
use App\Models\Hushtags;
use App\Models\Projects;
use App\Models\Contributions;

use Youaoi\MeCab\MeCab;
MeCab::setDefaults([
    
    // PATHが通っていないmecabを起動させる時に設定(default: mecab)
    // 'command' => 'usr/local/bin/mecab',
     
]);

use Auth;

class Clientcontroller extends Controller
{
    function projects(){
        $projects =Users::find(Auth::user()->id)->get_projects; //get_projects関数を実行(models/users)
        return view("client.projects", ["projects"=>$projects]);
    }

    function survey(Request $request){
        //DBよりデータの取得
        $questions_m =new Questions(); //questionsをインスタンス化(models/questions)
        $questions =$questions_m->get_questions($request->project_id); //get_questions関数を実行
        $question_id =array_column($questions->toArray(), "id"); //questionsのidのみを配列として格納
        $choices =$questions_m->get_choices($question_id); //question_idを使い、choicesを抽出
        $choice_answers =$questions_m->get_choice_answers($question_id); //question_idを使い、choice_answersを抽出
        $text_answers =$questions_m->get_text_answers($question_id); //question_idを使い、text_answersを抽出


        return view("client.survey",[
            "questions" =>$questions,
            "choices" =>$choices,
            "choice_answers" =>$choice_answers,
            "text_answers" =>$text_answers,
            "project_id" =>$request->project_id,
        ]);
    }

    function instagram(Request $request){
        //DBよりデータの取得
        $hushtags_m =new Hushtags(); //hushtagsをインスタンス化(models/hushtags)
        $hushtags =$hushtags_m->get_hushtags($request->project_id); //get_hushtags関数を実行
        foreach($hushtags as $hushtag){
            $hushtag_output=$this->hushtag_frequent($hushtag);
        }

        return view("client.instagram",[
            "hushtags" =>$hushtags,
            "project_id" =>$request->project_id,
            "hushtag_output"=>$hushtag_output,
        ]);
    }

    function api_test(){
        $projects_m =new Projects(); 
        $projects_m->store_api(); // projectModelのstore_apiを実行
        return redirect()->route('client.projects');
    }

    function analyze(){
        // $projects_m =new Projects();
        // $hushtags=$projects_m->get_running(); //進行中のプロジェクトのハッシュタグを取得
        // foreach($hushtags as $hushtag){
        //     $result=$this->hushtag_frequent($hushtag);
        // }
        
        // $command='echo "May J.がmacOSを搭載したMacBook ProをAir DOの機内に持ち込んだ。" | mecab';
        // $command="ls";
        // exec($command, $result, $return_ver);
        // dd($result);

        $mecab = new meCab();
        dd($mecab->analysis('すもももももももものうち'));

    }

    private static function hushtag_frequent($hushtag){ //頻出するハッシュタグの抽出を行う
        $contributions_m =new Contributions();
        $hushtag_array=[];
        $hushtag_output=[]; //最終的な出力結果
        $contributions =$contributions_m->get_contributions($hushtag); //投稿文のデータを取得
        if (is_null($contributions)==true){
            return $hushtag_output;
        }
            foreach($contributions as $contribution){
                $contribution_split=preg_split("/#/",$contribution->caption); //投稿文を[#]で分割
                unset($contribution_split[0]); //最初の要素を削除
                foreach($contribution_split as $tag){
                    $tag_split=preg_split("/\n/",$tag); //改行で分割
                    $tag_split=trim($tag_split[0]); //前後の空欄を削除
                    $tag_split=preg_split("/ /",$tag_split); // スペースで分割
                    $tag_split=preg_split("/　/",$tag_split[0]); // スペースで分割
                    array_push($hushtag_array, $tag_split[0]); //hushtag_arrayに挿入
                }
            }
            $h_output=array_count_values($hushtag_array); //各ハッシュタグの出現回数を算出
            arsort($h_output); //ソート
            $keys = array_keys($h_output);
            for($a = 0; $a < 50; $a++){
                $hushtag_output[]=[$keys[$a], $h_output[$keys[$a]]];
            }
            return $hushtag_output;
    }
    
}

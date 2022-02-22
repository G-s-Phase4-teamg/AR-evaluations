<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Questions;
use App\Models\Hushtags;
use App\Models\Projects;
use App\Models\Contributions;

use Youaoi\MeCab\MeCab;

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
        $choice_output=[];
        $text_output=[];

        //グラフ化しやすいようにデータの型を変形
        foreach($questions as $question){
            if($question->type==1){
                $c_array=$choices->where("question_id", $question->id)->sortBy('priority_key'); //質問の選択肢のみ抽出
                $c_choice=$c_array->pluck('choice')->all(); // 選択肢をarrayとして抽出
                $c_id=$c_array->pluck('id')->all(); //選択肢のidをarrayとして抽出
                $answer_array=[];
                foreach($c_id as $id){
                    $ans=$choice_answers->where("choice_id", $id)->pluck("count_answer")->all();
                    array_push($answer_array, $ans[0]);
                }
                array_push($choice_output, [array_values($answer_array), array_values($c_choice)]);
            } elseif($question->type==2){
                $t_array=$text_answers->where("question_id", $question->id)->pluck("answer")->all();
                array_push($text_output, $t_array);
            }
        }


        return view("client.survey",[
            "questions" =>$questions,
            "choice_output" =>$choice_output,
            "text_output" =>$text_output,
            "project_id" =>$request->project_id,
        ]);
    }

    function instagram(Request $request){
        //DBよりデータの取得
        $hushtags_m =new Hushtags(); //hushtagsをインスタンス化(models/hushtags)
        $hushtags =$hushtags_m->get_hushtags($request->project_id); //get_hushtags関数を実行
        //出力用のファイル
        $hushtag_output=[];
        $norn_output=[];
        $adjective_output=[];
        $verb_outpu=[];
        $data_len=0;

        foreach($hushtags as $hushtag){
            [$hushtag_output, $norn_output, $adjective_output, $verb_output, $data_len]=$this->analyze_processing($hushtag);
        }


        return view("client.instagram",[
            "hushtag" =>$hushtag,
            "project_id" =>$request->project_id,
            "hushtag_output"=>$hushtag_output,
            "norn_output"=>$norn_output,
            "adjective_output"=>$adjective_output,
            "verb_output"=>$verb_output,
            "data_len"=>$data_len,
        ]);
    }

    function api_test(){
        $projects_m =new Projects(); 
        $projects_m->store_api(); // projectModelのstore_apiを実行
        return redirect()->route('client.projects');
    }

    //analyze関数の分析を行う
    private static function analyze_processing($hushtag){ //頻出するハッシュタグの抽出を行う
        $mecab = new meCab();
        $contributions_m =new Contributions();
        $text_array=[];
        $T="";
        $hushtag_array=[];
        $hushtag_output=[]; //最終的な出力結果
        $norn_output=[];
        $adjective_output=[];
        $verb_output=[];
        $contributions =$contributions_m->get_contributions($hushtag); //投稿文のデータを取得
        $data_len=count($contributions);
        if (count($contributions)==0){
            return [$hushtag_output, $norn_output, $adjective_output, $verb_output];
        }else{
            foreach($contributions as $contribution){
                $text=""; //投稿文を保存する変数
                $contribution_split=preg_split("/#/",$contribution->caption); //投稿文を[#]で分割
                $text=$contribution_split[0];
                unset($contribution_split[0]); //最初の要素を削除
                foreach($contribution_split as $tag){
                    $tag_split=preg_split("/\n/",$tag); //改行で分割
                    $str =implode(" ", array_slice($tag_split, 1, count($tag_split))); //ハッシュタグ以外の部分を抽出　& 配列を文字列に変換
                    $text=$text. $str; 
                    $tag_split=trim($tag_split[0]); //前後の空欄を削除
                    $tag_split=preg_split("/ /",$tag_split); // スペースで分割
                    $tag_split=preg_split("/　/",$tag_split[0]); // スペースで分割
                    array_push($hushtag_array, $tag_split[0]); //hushtag_arrayに挿入
                }
                $text= str_replace("\n", " ", $text); //改行を空白に変換
                $T=$T. $text;
                array_push($text_array, $text);

            }

             //各ハッシュタグの出現回数を算出
            $h_output=array_count_values($hushtag_array); 
            arsort($h_output); //ソート
            $keys = array_keys($h_output); //
            $count=count($h_output);
            if($count>=50){
                for($a = 0; $a < 50; $a++){
                    $hushtag_output[]=[$keys[$a], $h_output[$keys[$a]]];
                }
            }else{
                for($a = 0; $a < $count; $a++){
                    $hushtag_output[]=[$keys[$a], $h_output[$keys[$a]]];
                }
            }


            // 自然言語処理（形態素解析）
            $text_noun=[]; //名詞を格納
            $text_adjective=[]; //形容詞を格納
            $text_verb=[]; //動詞を格納
            $mors=$mecab->analysis($T);

            $norn = array_filter($mors, function ($element) { //名詞のみ抽出
                return $element->speech == "名詞";
            });
            $adjective = array_filter($mors, function ($element) { //形容詞のみ抽出
                return $element->speech == "形容詞";
            });
            $verb = array_filter($mors, function ($element) { //動詞のみ抽出
                return $element->speech == "動詞";
            });
            $norn_array=array_column($norn, "text"); //連想配列からtextのみ抽出
            $adjective_array=array_column($adjective, "original");
            $verb_array=array_column($verb, "original");

            $test = array_filter($adjective, function ($element) { 
                return $element->original == "自動獲得:テキスト";
            });

            $n_output=array_count_values($norn_array); //各名詞の出現回数を算出
            $a_output=array_count_values($adjective_array);  //各形容詞の出現回数を算出
            $v_output=array_count_values($verb_array); //各動詞の出現回数を算出

            arsort($n_output); //ソート
            arsort($a_output);
            arsort($v_output);

            //５０個のデータのみを取り出し
            $keys = array_keys($n_output);
            $count=count($n_output);
            if($count>=50){
                for($a = 0; $a < 50; $a++){
                    $norn_output[]=[$keys[$a], $n_output[$keys[$a]]];
                }
            }else{
                for($a = 0; $a < $count; $a++){
                    $norn_output[]=[$keys[$a], $n_output[$keys[$a]]];
                }
            }

            $keys = array_keys($a_output);
            $count=count($a_output);
            if($count>=50){
                for($a = 0; $a < 51; $a++){
                    if ($keys[$a]!="自動獲得:テキスト"){
                        $str=$keys[$a];
                        $str= str_replace('代表表記:', '', $str);
                        $str_ar= explode("/",$str);
                        $adjective_output[]=[$str_ar[0], $a_output[$keys[$a]]];
                    }
                }
            }else{
                for($a = 0; $a < $count; $a++){
                    if ($keys[$a]!="自動獲得:テキスト"){
                        $str=$keys[$a];
                        $str= str_replace('代表表記:', '', $str);
                        $str_ar= explode("/",$str);
                        $adjective_output[]=[$str_ar[0], $a_output[$keys[$a]]];
                    }
                }
            }

            $keys = array_keys($v_output);
            $count=count($v_output);
            if($count>=50){
                for($a = 0; $a < 51; $a++){
                    if ($keys[$a]!="自動獲得:テキスト"){
                        $str=$keys[$a];
                        $str= str_replace('代表表記:', '', $str);
                        $str_ar= explode("/",$str);
                        $verb_output[]=[$str_ar[0], $v_output[$keys[$a]]];
                    }
                }
            }else{
                for($a = 0; $a < $count; $a++){
                    if ($keys[$a]!="自動獲得:テキスト"){
                        $str=$keys[$a];
                        $str= str_replace('代表表記:', '', $str);
                        $str_ar= explode("/",$str);
                        $verb_output[]=[$str_ar[0], $v_output[$keys[$a]]];
                    }
                }
            }

            
            return [$hushtag_output, $norn_output, $adjective_output, $verb_output, $data_len];
        }
    }
    
}

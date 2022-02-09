<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Questions;

use Auth;

class Clientcontroller extends Controller
{
    function projects(){
        $projects =Users::find(Auth::user()->id)->get_projects; //get_projects関数を実行(models/users)
        return view("client.projects", ["projects"=>$projects]);
    }

    function survey(Request $request){
        //DBよりデータの取得
        $questions_m =new Questions(); //questionsをインスタンス化
        $questions =$questions_m->get_questions($request->project_id); //get_questions関数を実行(models/questions)
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
}

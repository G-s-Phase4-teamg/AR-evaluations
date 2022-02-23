<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Users;
use App\Models\Customers;
use App\Models\Choice_answers;

class UserController extends Controller
{
    
   
    function questions(Request $request){
        $questions_m =new Questions(); //questionsをインスタンス化(models/questions)
        $questions =$questions_m->get_questions($request->project_id); //get_questions関数を実行

        return view("question");
    }
    
    function store(Request $request){
        $project_id=1;
        $now_time=now();
        $data = Customers::create([
            'project_id'=>$project_id,
        ]);
        choice_answers::create([
            "question_id"=> 1,
            "choice_id"=> $request->q_one ,
            "customer_id"=> $data->id,
        ]);
        foreach($request->q_two as $answer){
            echo($answer);
            choice_answers::create([
                "question_id"=> 2,
                "choice_id"=> $answer ,
                "customer_id"=> $data->id,
            ]);
        }
        dd($request->q_two);
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Users;

class UserController extends Controller
{
    
   
    function questions(Request $request){
        $questions_m =new Questions(); //questionsをインスタンス化(models/questions)
        $questions =$questions_m->get_questions($request->project_id); //get_questions関数を実行
    }
    
    function choises(){
        
    }
    
}

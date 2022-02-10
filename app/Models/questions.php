<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Questions;
use App\Models\Choices;
use App\Models\Choice_answers;
use App\Models\Text_answers;

class questions extends Model
{
    use HasFactory;

    public function get_questions($project_id){ //project_idが一致するデータをquestionsテーブルから抽出
        $questions=Questions::where("project_id", $project_id)->orderby("priority_key")->get(); 
        return $questions;
    }
    public function get_choices($question_id){ //question_idに含まれるデータをchoicesテーブルから抽出
        $choices=Choices::whereIn("question_id", $question_id)->orderby("priority_key")->get(); 
        return $choices;
    }
    public function get_choice_answers($question_id){ //question_idに含まれるデータをchoice_answersテーブルから抽出
        $choice_answers=Choice_answers::whereIn("question_id", $question_id)->get();
        return $choice_answers;
    }
    public function get_text_answers($question_id){ //question_idに含まれるデータをtext_answersテーブルから抽出
        $text_answers=Text_answers::whereIn("question_id", $question_id)->get();
        return $text_answers;
    }
}

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

    public function get_questions($project_id){
        $questions=Questions::where("project_id", $project_id)->orderby("priority_key")->get(); //project_idが一致するデータをquestionsテーブルから抽出
        return $questions;
    }
    public function get_choices($question_id){
        $choices=Choices::whereIn("question_id", $question_id)->orderby("priority_key")->get(); //question_idに含まれるデータをchoicesテーブルから抽出
        return $choices;
    }
    public function get_choice_answers($question_id){
        $choice_answers=Choice_answers::whereIn("question_id", $question_id)->get();
        return $choice_answers;
    }
    public function get_text_answers($question_id){
        $text_answers=Text_answers::whereIn("question_id", $question_id)->get();
        return $text_answers;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\customers;
use App\Models\projects;

class customers extends Model
{
    use HasFactory;


    protected $fillable = ['project_id'];
    
    public function get_user_len($project_id){ //project_idが一致するデータをquestionsテーブルから抽出
        $customers=Customers::where("project_id", $project_id)->get();
        $user_len=count($customers);
        return $user_len;
    }

    //ARユーザーの関数
    public function get_customers($project_id){ //project_idが一致するデータをcustomersテーブルから抽出
        $customers=customers::where("project_id", $project_id)->orderby("updated_at")->get(); 
        return $customers;
    }
}

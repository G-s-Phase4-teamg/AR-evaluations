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

    //ARユーザーの関数
    public function get_customers($project_id){ //project_idが一致するデータをcustomersテーブルから抽出
        $customers=customers::where("project_id", $project_id)->orderby("updated_at")->get(); 
        return $customers;
    }
}

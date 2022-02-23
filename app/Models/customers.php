<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;

    public function get_user_len($project_id){ //project_idが一致するデータをquestionsテーブルから抽出
        $customers=Customers::where("project_id", $project_id)->get();
        $user_len=count($customers);
        return $user_len;
    }
}

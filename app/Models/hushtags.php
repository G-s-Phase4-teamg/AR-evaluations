<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hushtags extends Model
{
    use HasFactory;
    function get_hushtags($project_id){ //project_idが一致するデータをhushtagsテーブルから抽出
        $hushtags =Hushtags::where("project_id", $project_id)->get(); 
        return $hushtags;
    }
}

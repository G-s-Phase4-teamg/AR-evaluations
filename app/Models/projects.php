<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hushtags;

class projects extends Model
{
    use HasFactory;

    public function store_api(){
        $now =now(); //現在時刻を取得
        $project_ids=Projects::select("id")->where("released_at", "<", $now)->where("closed_at", ">", $now)->get();//released_at<現在時刻<closed_atのproject_idを取得
        $hushtags=Hushtags::whereIn("project_id", $project_ids)->get(); //project_idsに含まれるハッシュタグを所得
        foreach ($hushtags as $hushtag){
            echo $hushtag;
        }
        
    }
}

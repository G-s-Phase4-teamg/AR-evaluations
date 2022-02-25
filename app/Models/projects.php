<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hushtags;
use App\Models\Contributions;
use App\Http\Controllers\ApiController;

class projects extends Model
{
    use HasFactory;

    public function store_api(){
        $api_m=new ApiController; //apiコントローラをインスタンス化
        $now =now(); //現在時刻を取得
        $project_ids=Projects::select("id")->where("released_at", "<", $now)->where("closed_at", ">", $now)->get();//released_at<現在時刻<closed_atのproject_idを取得
        $hushtags=Hushtags::whereIn("project_id", $project_ids)->get(); //project_idsに含まれるハッシュタグを所得
        foreach ($hushtags as $hushtag){ 
            $contributions= $api_m->index($hushtag -> hushtag); //各ハッシュタグごとにAPIを実行（APIの仕様上、最大４回）
            foreach ($contributions as $contribution){

                if (isset($contribution["media_url"])==false){
                    $contribution["media_url"]="";
                }
                if (isset($contribution["caption"])==false){
                    $contribution["caption"]="";
                }
                if (isset($contribution["permalink"])==false){
                    $contribution["permalink"]="";
                }
                
                Contributions::create([ //所得したデータをcontributionテーブルに保存
                    "hushtag_id"=> $hushtag->id,
                    "instagram_id"=> $contribution["id"],
                    "media_url"=> $contribution["media_url"],
                    "permalink"=> $contribution["permalink"],
                    "caption"=> $contribution["caption"],
                    "updated_at"=> date("Y-m-d H:i:s" ,strtotime($contribution["timestamp"])),
                    "created_at"=> $now,
                ]);
            }
        }
        return;
    }

    public function get_running(){
        $now =now(); //現在時刻を取得
        $project_ids=Projects::select("id")->where("released_at", "<", $now)->where("closed_at", ">", $now)->get();//released_at<現在時刻<closed_atのproject_idを取得
        $hushtags=Hushtags::whereIn("project_id", $project_ids)->first(); //project_idsに含まれるハッシュタグを所得
        return $hushtags;
    }
}

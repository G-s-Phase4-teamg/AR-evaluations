<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contributions;

class Contributions extends Model
{
    use HasFactory;

    protected $fillable=["hushtag_id", "instagra,_id", "media_url", "permalink", "caption", "updated_at"]; //保存可能な列を選択

    public function get_contributions($hushtag){
        $contributions =Contributions::where("hushtag_id", $hushtag->id)->get();
        return $contributions;
    }
}

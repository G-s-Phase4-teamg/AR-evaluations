<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Projects;

class users extends Model
{
    use HasFactory;
    public function get_projects(){ //user_idが一致するデータをprojectsテーブルから抽出
        return $this->hasMany(Projects::class)->orderby("released_at");
    }
}

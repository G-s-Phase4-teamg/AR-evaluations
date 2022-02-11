<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projects extends Model
{
    use HasFactory;

    public function store_api(){
        $project_ids=Projects::select("id")->get();
        dd($project_ids);
    }
}

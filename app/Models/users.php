<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;

class users extends Model
{
    use HasFactory;
    public function get_projects(){
        return $this->hasMany(Users::class);
    }
}

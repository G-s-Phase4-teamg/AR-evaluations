<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributions extends Model
{
    use HasFactory;

    protected $fillable=["hushtag_id", "instagra,_id", "media_url", "permalink", "caption", "updated_at"];
}

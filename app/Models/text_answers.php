<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class text_answers extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', "answer", "customer_id"];
}

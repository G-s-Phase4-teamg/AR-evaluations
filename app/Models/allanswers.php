<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class allanswers extends Model
{
    use HasFactory;
    protected $table = 'allanswers';
    protected $fillable = array('text');
    public $timestamps = false;
}


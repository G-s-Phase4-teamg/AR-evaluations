<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Clientcontroller extends Controller
{
    function projects(){
        return view("client.projects");
    }
}

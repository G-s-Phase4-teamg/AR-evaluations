<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Auth;

class Clientcontroller extends Controller
{
    function projects(){
        $projects =Users::find(Auth::user()->id)->get_projects;
        return view("client.projects", ["projects"=>$projects]);
    }

    function survey(){
        return view("client.survey");
    }
}

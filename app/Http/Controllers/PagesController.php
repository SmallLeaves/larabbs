<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use Auth;
class PagesController extends Controller
{
    public function root(){
        return view('pages.root');
    }
}

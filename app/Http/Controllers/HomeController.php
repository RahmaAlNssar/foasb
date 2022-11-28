<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
      //  $count_complains = Complain::select()->count(*)->where('seen',0);
        return view('dashboard');
    }
}

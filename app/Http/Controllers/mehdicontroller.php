<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mehdicontroller extends Controller
{
    public function index(){
        return'mehdi page';
    }
   public function person($ad){
        return '$ad mehdi information';
   }


}


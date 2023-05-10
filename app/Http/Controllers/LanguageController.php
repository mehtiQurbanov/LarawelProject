<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLanguage($lang, Request $request)
    {
        $request->session()->put("lang", $lang);
        return redirect()->back();
    }
}

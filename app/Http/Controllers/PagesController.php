<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        //How to pass values
        $title='Welcome to laravel D.A';
       // 1. return view('pages.index', compact('title'));

       //or 2.
       return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title='Welcome to laravel ABOUT page';
        return view('pages.about')->with('title', $title);
    }

    //passing multile values
    public function services(){
       $data = array(
            'title' => 'Services',
            'services' => ['Web design', 'Programming', 'SEO']
       );
        return view('pages.services')->with($data);
    }
}

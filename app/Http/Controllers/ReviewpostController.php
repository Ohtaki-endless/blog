<?php

namespace App\Http\Controllers;

use App\Reviewpost;
use Illuminate\Http\Request;

class ReviewpostController extends Controller
{
    public function index(Reviewpost $post) 
    {
        return view('test.index')->with(['posts' => $post->get()]); 
    }
}

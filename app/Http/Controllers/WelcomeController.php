<?php

namespace CodePub\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        if (\Auth::check()) {
            return redirect()->route('home');
        }
        return view('welcome');
    }
}

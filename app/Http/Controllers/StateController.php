<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class StateController extends Controller
{
    public function index(){
        return Inertia::render('State/Index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CountryController extends Controller
{
    public function index(){
        return Inertia::render('Country/Index');
    }
}
<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecipieController extends Controller
{
    public function index() {
        return view('admin-views.recipie.index');    
    }

    public function add() {
        return view('admin-views.recipie.add');
    }
}

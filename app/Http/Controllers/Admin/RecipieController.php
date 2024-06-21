<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class RecipieController extends Controller
{
    public function index() {
        return view('admin-views.recipie.index');    
    }

    public function add() {
        $products = Product::orderBy('name', 'ASC')->get();
        return view('admin-views.recipie.add', compact('products'));
    }
}

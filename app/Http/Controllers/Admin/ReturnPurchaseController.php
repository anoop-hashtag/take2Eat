<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReturnPurchaseController extends Controller
{
    public function index() {
        return view('admin-views.return-purchase.index');
    }

    public function add() {
        return view('admin-views.return-purchase.add');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Ingredient;
use Illuminate\Http\Request;

class RecipieController extends Controller
{
    public function index() {
        return view('admin-views.recipie.index');    
    }

    public function add() {
        $products = Product::orderBy('name', 'ASC')->get();
        $ingredients = Ingredient::orderBy('name', 'ASC')->get();
        return view('admin-views.recipie.add', compact('products', 'ingredients'));
    }

    public function productVarition($id) {
        $response = $data = [];
        $productDetails = Product::find($id);
        $variations = json_decode($productDetails->variations);
        if(count($variations) > 0) {
            for($i = 0; $i < count($variations[0]->values); $i++) {
                $label = $variations[0]->values[$i]->label;
                array_push($data, $label);
            }
            $response['status'] = 200;
            $response['data'] = $data;
        } else {
            $response['status'] = 401;
        }
        return $response;
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Ingredient;
use App\Model\Recipie;
use App\Model\RecipieIngredient;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

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

    public function store(Request $request) {
        if(isset($request->items)) {
            if(count($request->items) > 0) {
                $product_id = $request->product;
                $product_details = Product::find($product_id);
        
                $recipie = new Recipie();
                $recipie->product_id = $product_id;
                $recipie->product_details = json_encode($product_details);
                $recipie->variation = isset($request->variation) ? $request->variation : '';
                $recipie->save();
                $recipie_id = $recipie->id;
    
                for($i = 0; $i < count($request->items); $i++) {
                    $ingredient_id = $quantity = $quantity_type = '';
    
                    $ingredient_id = $request->items[$i];
                    $ingredient_details = Ingredient::find($ingredient_id);
                    $quantity = $request->quantitys[$i];
                    $quantity_type = $request->quantity_types[$i];
    
                    $recipieIngredient = new RecipieIngredient();
                    $recipieIngredient->recipie_id = $recipie_id;
                    $recipieIngredient->ingredient_id = $ingredient_id;
                    $recipieIngredient->ingredient_details = json_encode($ingredient_details);
                    $recipieIngredient->quantity = $quantity;
                    $recipieIngredient->quantity_type = $quantity_type;
                    $recipieIngredient->save();
                }
                Toastr::success('Recipe created successfully');
                return redirect('admin/recipe');
            }
        } else {
            Toastr::error('Please add atleast a ingredient');
            return back();
        }        
    }
}

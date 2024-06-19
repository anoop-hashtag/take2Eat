<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Vendor;
use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\Ingredient;

class ReturnPurchaseController extends Controller
{
    public function index() {
        return view('admin-views.return-purchase.index');
    }

    public function add() {
        $vendors = Vendor::where('status', '1')->orderBy('name', 'asc')->get();
        $ingredients = Ingredient::where('status', '1')->orderBy('name', 'asc')->get();
        return view('admin-views.return-purchase.add', compact('vendors'));
    }

    public function edit(Request $request) {
        $request->validate([
            'vendor_id' => 'required',
            'invoice' => 'required'
        ]);

        $vendor_id = $request->vendor_id;
        $invoice = $request->invoice;
        $purchaseIngredients = Purchase::select('purchases.*', 'purchases_ingredient_items.id as purchases_ingredient_items_id', 'purchases_ingredient_items.ingredient_details', 'purchases_ingredient_items.quantity', 'purchases_ingredient_items.rate')
                                        ->leftJoin('purchases_ingredient_items', 'purchases.id', '=', 'purchases_ingredient_items.purchase_id')
                                        ->where('purchases.vendor_id', '=', $request->vendor_id)
                                        ->where('purchases.invoice', '=', $request->invoice)
                                        ->get();

        $vendors = Vendor::where('status', '1')->orderBy('name', 'asc')->get();
        $ingredients = Ingredient::where('status', '1')->orderBy('name', 'asc')->get();
        return view('admin-views.return-purchase.add', compact('vendors', 'purchaseIngredients', 'ingredients', 'vendor_id', 'invoice'));
    }

    public function store(Request $request) {
        echo "<pre>";
        print_r($request->all());
        
        if(isset($request->return_ingredients)) {
            if(count($request->return_ingredients) > 0) {
                $purchase_id = $request->purchase_id;

                
            } 
        }
    }
}

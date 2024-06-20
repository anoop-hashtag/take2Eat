<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Vendor;
use Illuminate\Http\Request;
use App\Model\Purchase;
use App\Model\Ingredient;
use App\Model\ReturnPurchase;
use App\Model\ReturnPurchaseIngredientItem;
use Brian2694\Toastr\Facades\Toastr;

class ReturnPurchaseController extends Controller
{
    public function index() {
        $returnPurchases = ReturnPurchase::select('return_purchase.*', 'purchases.invoice', 'vendors.name', 'vendors.mobile')
                                            ->leftJoin('purchases', 'return_purchase.purchase_id', '=', 'purchases.id')
                                            ->leftJoin('vendors', 'purchases.vendor_id', '=', 'vendors.id')
                                            ->get();
        return view('admin-views.return-purchase.index', compact('returnPurchases'));
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
        if(isset($request->return_ingredients)) {
            if(count($request->return_ingredients) > 0) {
                $purchase_id = $request->purchase_id;

                $return_purchase = new ReturnPurchase();
                $return_purchase->purchase_id = $purchase_id;
                $return_purchase->note = isset($request->note) ? $request->note : '';
                $return_purchase->save();
                $return_purchase_id = $return_purchase->id;

                for($i = 0; $i < count($request->return_ingredients); $i++) {
                   $index = array_keys($request->return_ingredients)[$i];
                   $return_ingredients_id = $items = $quantitys = '';

                   $return_ingredients_id = $request->return_ingredients[$index];
                   $items = $request->items[$index];
                   $quantitys = $request->quantitys[$index];

                   $return_purchase_ingredient_item = new ReturnPurchaseIngredientItem();
                   $return_purchase_ingredient_item->return_purchase_id = $return_purchase_id;
                   $return_purchase_ingredient_item->purchase_ingredient_id = $return_ingredients_id;
                   $return_purchase_ingredient_item->return_quantity = $quantitys;
                   $return_purchase_ingredient_item->save();

                   $ingredient = Ingredient::find($items);
                   $ingredient->quantity = $ingredient->quantity - $quantitys;
                   $ingredient->update();
                }
            } 
            Toastr::success('Return Purchase added successfully');
            return redirect('admin/return-purchase');
        } else {
            Toastr::error('Please select atleast one ingredient');
            return redirect('admin/return-purchase/add');
        }
    }

    public function view($id) {
        $returnPurchaseIngredientItems = ReturnPurchaseIngredientItem::select('return_purchase_ingredient_items.*', 'purchases_ingredient_items.ingredient_details')
            ->leftJoin('purchases_ingredient_items', 'purchases_ingredient_items.id', '=', 'return_purchase_ingredient_items.purchase_ingredient_id')
            ->where('return_purchase_ingredient_items.return_purchase_id', $id)
            ->get(); 

        $returnPurchase = ReturnPurchase::select('purchases.invoice', 'vendors.name', 'return_purchase.created_at')
                                    ->leftJoin('purchases', 'purchases.id', '=', 'return_purchase.purchase_id')
                                    ->leftJoin('vendors', 'vendors.id', '=', 'purchases.vendor_id')
                                    ->where('return_purchase.id', $id)
                                    ->get();

        return view('admin-views.return-purchase.view', compact('returnPurchaseIngredientItems', 'returnPurchase'));
    }
}

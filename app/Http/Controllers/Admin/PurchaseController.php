<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Vendor;
use App\Model\Ingredient;
use App\Model\Purchase;
use App\Model\PurchasesIngredientItem;
use Brian2694\Toastr\Facades\Toastr;

class PurchaseController extends Controller
{
    public function index() {
        return view('admin-views.purchase.index');
    }

    public function add() {
        $vendors = Vendor::where('status', '1')->orderBy('name', 'asc')->get();
        $ingredients = Ingredient::where('status', '1')->orderBy('name', 'asc')->get();
        return view('admin-views.purchase.add', compact('vendors', 'ingredients'));
    }

    public function store(Request $request) {

        $request->validate([
            'vendor_id' => 'required',
            'invoice' => 'required',
            'purchase_date' => 'required',
            'payment_type' => 'required',
        ]);

        $purchase = new Purchase();
        $purchase->vendor_id = $request->vendor_id;
        $purchase->invoice = $request->invoice;
        $purchase->purchase_date = $request->purchase_date;
        $purchase->payment_type = $request->payment_type;
        $purchase->note = $request->note;
        $purchase->save();
        $purchase_id = $purchase->id;  
        
        for($i = 0; $i < count($request->items); $i++) {
            $ingredient_id = $request->items[$i];
            $quantity = $request->quantitys[$i];
            $rate = $request->rates[$i];

            $ingredient_details = Ingredient::find($ingredient_id);

            $purchase_ingredient_item = new PurchasesIngredientItem();
            $purchase_ingredient_item->purchase_id = $purchase_id;
            $purchase_ingredient_item->ingredient_details = json_encode($ingredient_details);
            $purchase_ingredient_item->quantity = $quantity;
            $purchase_ingredient_item->rate = $rate;
            $purchase_ingredient_item->save();

            $ingredient_details->quantity = $ingredient_details->quantity + $quantity;
            $ingredient_details->update();
        }

        Toastr::success('Purchase added successfully');
        return redirect('admin/purchase');
    }
}

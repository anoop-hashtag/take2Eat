<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Ingredient;
use Brian2694\Toastr\Facades\Toastr;

class IngredientController extends Controller
{
    public function index() {
        // $ingredients = Ingredient::all();
        return view('admin-views.ingredient.index');
        // return view('admin-views.ingredient.index', compact('ingredients'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required | unique:ingredients,name',
            'quantity_type' => 'required',
        ],[
            'name.unique' => translate('Ingredient name is already taken'),
        ]);

        $ingredient = new Ingredient;
        $ingredient->name = $request->name;
        $ingredient->quantity_type = $request->quantity_type;
        $ingredient->save();

        Toastr::success('Ingredient added successfully');
        return redirect('admin/ingredient');
    }
}

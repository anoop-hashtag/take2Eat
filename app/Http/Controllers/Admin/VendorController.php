<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Vendor;
use Brian2694\Toastr\Facades\Toastr;

class VendorController extends Controller
{
    public function index() {
        $vendors = Vendor::all(); 
        return view('admin-views.vendor.index', compact('vendors'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required | unique:vendors,mobile',
            'email' => 'required | unique:vendors,email',
        ],[
            'mobile.unique' => translate('Mobile is already exists'),
            'email.unique' => translate('Email is already exists')
        ]);

        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->mobile = $request->mobile;
        $vendor->email = $request->email;
        $vendor->gst = $request->gst;
        $vendor->address = $request->address;
        $vendor->save();

        Toastr::success('Vendor added successfully');
        return redirect('admin/vendor');
    }
}

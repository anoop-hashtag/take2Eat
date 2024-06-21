@extends('layouts.admin.app')

@section('title', translate('Vendor'))
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
    box-sizing: border-box !important;
    display: inline-block !important;
    min-width: 1.5em !important;
    padding: .5em 1em !important;
    margin-left: 2px !important;
    text-align: center !important;
    text-decoration: none !important;
    cursor: pointer !important;
    color: #8c98a4 !important;
    border: 1px solid transparent !important;
    border-radius: .3125rem !important;
}
.page-item.active .page-link {
    z-index: 3;
    color: #fff!important;
    background-color: #ff611d;
    border-color: #ff611d;
}
    .datatable_wrapper_row .dt-buttons {
    display: inline-flex;
    gap: 8px;
    margin-top: 0 !important;
}
table.dataTable.no-footer {
    border-bottom: 1px solid #111;
}
</style>
@section('content')
        
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/inventory/supplier.png')}}" alt="">
            <span class="page-header-title">
                {{translate('vendor')}} 
            </span>
        </h2>
    </div>
    <!-- End Page Header -->

    <div class="row g-2">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.vendor.update', [$vendor->id]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="input-label">{{translate('Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ $vendor->name }}" placeholder="{{translate('vendor')}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="input-label">{{translate('Mobile')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile" class="form-control" value="{{ $vendor->mobile }}" placeholder="{{translate('Mobile')}}" required onkeyup="validateMobileNumber(this)">
                                </div>

                                <div class="form-group">
                                    <label class="input-label">{{translate('Address')}} <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" placehder="{{translate('Ex: ABC')}}" style="resize: none;">{{ $vendor->address }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="input-label">{{translate('Email')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control" value="{{ $vendor->email }}" placeholder="{{translate('abc@gmail.com')}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="input-label">{{translate('GST')}}</label>
                                    <input type="text" name="gst" class="form-control" value="{{ $vendor->gst }}" placeholder="{{translate('GST')}}">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button type="reset" id="reset" class="btn btn-secondary">{{translate('Reset')}}</button>
                            <button type="submit" class="btn btn-primary">{{translate('Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

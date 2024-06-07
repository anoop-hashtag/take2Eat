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
                {{translate('Supplier')}} 
            </span>
        </h2>
    </div>
    <!-- End Page Header -->

    <div class="row g-2">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form>
                
                <div class="card">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label">{{translate('Name')}}</label>
                                        <input type="text" name="name" class="form-control" placeholder="{{translate('Ingredients')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-label">{{translate('Mobile')}} </label>
                                        <input type="text" name="mobile" class="form-control" placeholder="{{translate('Mobile')}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="input-label">{{translate('Address')}}</label>
                                        <textarea name="address" class="form-control" required="" placeholder="{{translate('Ex: ABC')}}" style="resize: none;"></textarea>
                                </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label">{{translate('Email')}}</label>
                                        <input type="text" name="email" class="form-control" placeholder="{{translate('ABC@gmail.com')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-label">{{translate('GST')}}</label>
                                        <input type="text" name="gst" class="form-control" placeholder="{{translate('GST')}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <button type="reset" id="reset" class="btn btn-secondary">{{translate('Reset')}}</button>
                                <button type="submit" class="btn btn-primary">{{translate('Add')}}</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-12">
            <!-- Card -->
            <div class="card">
                <div class="new-top px-card ">
                    <div class="row align-items-center gy-2">
                        <div class="col-sm-4 col-md-6 col-lg-8">
                            {{-- <h5 class="d-flex align-items-center gap-2 mb-0">
                                {{translate('Supplier_List')}}
                                <span class="badge badge-soft-dark rounded-50 fz-12">10</span>
                            </h5> --}}
                        </div>
                        <div class="col-sm-8 col-md-6 col-lg-4">
                            <form action="" method="GET">
                                <div class="input-group">
                                    {{-- <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="{{translate('Search_by_Title')}}" aria-label="Search" value="" required="" autocomplete="off"> --}}
                                    <div class="input-group-append">
                                        {{-- <button type="submit" class="btn btn-primary">
                                            {{translate('Search')}}
                                        </button> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="set_table banner-tbl">
                    <div class="table-responsive datatable_wrapper_row " >
                        <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('name')}}</th>
                                <th> {{translate('Contact Info')}}</th>
                                <th> {{translate('Address')}}</th>
                                <th> {{translate('Action')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Stock 1</td>
                                    <td>
                                        <div><a href="#" class="text-dark"><strong>{{translate('email')}}</strong></a></div>
                                        <div><a class="text-dark" href="#">9876543210</a></div>
                                   </td>
                                   <td>{{translate('lucknow')}}</td>
                                    <td>
                                        <div class="d-flex  gap-2">
                                            <a class="btn btn-outline-info btn-sm edit square-btn"
                                                href="#"><i class="tio-edit"></i></a>
                                         </div>
                                        
                                    </td>
                                </tr>
                        
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4 px-3 pagination-style">
                        <div class="d-flex justify-content-lg-end justify-content-sm-end">
                            <!-- Pagination -->
                          
                        </div>
                    </div>
                </div>
                <!-- End Table -->
            </div>
            <!-- End Card -->
        </div>
    </div>
</div>

@endsection
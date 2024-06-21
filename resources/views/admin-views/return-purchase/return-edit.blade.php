@extends('layouts.admin.app')

@section('title', translate('Edit_Return_Purchase'))


@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/inventory/return.png')}}" alt="">
            <span class="page-header-title">
                {{translate('Edit_Return_Purchase')}} 
            </span>
        </h2>
    </div>
    <!-- End Page Header -->

    <div class="row g-2">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <div class="card">
                <form action="{{ route('admin.return-purchase.edit') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">{{translate('vendor')}}<span class="text-danger">*</span></label>
                                        <select name="vendor_id" class="custom-select" >
                                           <option value="1">1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">{{translate('Invoice')}}<span class="text-danger">*</span></label>
                                        <input type="number" name="invoice" class="form-control" placeholder="{{ translate('Ex: ABC123') }}" value="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Table -->
                <div class="set_table banner-tbl mt-4" >
                    <div class="table-responsive datatable_wrapper_row">
                        <table id="datatable"  class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th><input type="checkbox" name="text" required></th>
                                <th style="width: 35%;">{{translate('Item')}}</th>
                                <th style="width: 15%;">{{translate('quantity')}}</th>
                                <th style="width: 15%;">{{translate('quantity_type')}}</th>
                                <th style="width: 15%;">{{translate('rate')}}</th>
                                <th style="width: 15%;">{{translate('total')}}</th>
                            </tr>
                            </thead>
                                <form  method="post">
                                    <tbody>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="" class="form-control" value="">
                                                </td>
                                                <td>
                                                    <select name="" class="custom-select items">
                                                        <option selected disabled>{{translate('select_item')}}</option>
                                                       <option value="item1">Item1</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="" class="form-control quantity" value="" required>
                                                    <input type="hidden" class="main_quantity" value="" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control quantity_type" value="" >
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control rate" value="" >
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control total" value="" readonly>
                                                </td>
                                            </tr>
  

                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end gap-3 m-4">
                                    <button type="reset" id="reset" class="btn btn-secondary">{{translate('reset')}}</button>
                                    <button type="submit" class="btn btn-primary">{{translate('return')}}</button>
                                </div>
                            </form>
                    
                    </div>
                </div>
                <!-- End Table -->
                
            </div>
            <!-- End Card -->
        </div>
    </div>
</div>


@endsection

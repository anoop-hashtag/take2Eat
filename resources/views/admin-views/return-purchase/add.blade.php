@extends('layouts.admin.app')

@section('title', translate('Add Return Purchase'))

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/inventory/return.png')}}" alt="">
            <span class="page-header-title">
                {{translate('Add Return Purchase')}} 
            </span>
        </h2>
    </div>
    <!-- End Page Header -->

    <div class="row g-2">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form>
                <div class="card">
                   
                        <div class="card">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5 col-sm-5">
                                    <div class="form-group">
                                        <label class="input-label">{{translate('Supplier_Name')}}<span
                                                class="input-label-secondary">*</span></label>
                                        <select name="qty_type" class="custom-select" >
                                            <option selected disabled>Select any supplier</option>
                                            <option value="kg">{{translate('Supplier 1')}}</option>
                                            <option value="litre">{{translate('Supplier 2')}}</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-5 col-sm-5">
                                    <div class="form-group">
                                        <label class="input-label">{{translate('Invoice')}}<span
                                                class="input-label-secondary">*</span></label>
                                        <select name="qty_type" class="custom-select" >
                                            <option selected disabled>Select invoice</option>
                                            <option value="kg">{{translate('invoice_1')}}</option>
                                            <option value="litre">{{translate('invoice_2')}}</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-2 col-sm-2">
                                    <div class="form-group mt-5">
                                    
                                    <button type="submit" class="btn btn-primary">{{translate('Search')}}</button>
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
                                <th><div> <input type="checkbox" name="text" required>
                                </div></th>
                        
                                <th>{{translate('Ingredient')}}</th>
                                <th> {{translate('Qty')}}</th>
                                <th> {{translate('Rate')}}</th>
                                <th> {{translate('Total')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <div> <input type="checkbox" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                        </div>
                                        </td>
                                    
                                       
                                        <td>
                                        <div><select name="qty_type" class="custom-select" >
                                            <option selected disabled>{{translate('Select any ingredient')}}</option>
                                            <option value="kg">{{translate('Oil')}}</option>
                                            <option value="litre">{{translate('Ginger')}}</option>
                                            </select>
                                        </div>
                                    </td>
                                  <td>
                                    <div> <input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                    </div>
                                    </td>
                                    <td>
                                        <div><input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div><input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required disabled>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div> <input type="checkbox" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                        </div>
                                        </td>
                                    
                                    
                                        <td>
                                        <div><select name="qty_type" class="custom-select" >
                                            <option selected disabled>{{translate('Select any ingredient')}}</option>
                                            <option value="kg">{{translate('Oil')}}</option>
                                            <option value="litre">{{translate('Ginger')}}</option>
                                            </select>
                                        </div>
                                    </td>
                                  <td>
                                    <div> <input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                    </div>
                                    </td>
                                    <td>
                                        <div><input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div><input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required disabled>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div> <input type="checkbox" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                        </div>
                                        </td>
                                    
                                    
                                        <td>
                                        <div><select name="qty_type" class="custom-select" >
                                            <option selected disabled>{{translate('Select any ingredient')}}</option>
                                            <option value="kg">{{translate('Oil')}}</option>
                                            <option value="litre">{{translate('Ginger')}}</option>
                                            </select>
                                        </div>
                                    </td>
                                  <td>
                                    <div> <input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                    </div>
                                    </td>
                                    <td>
                                        <div><input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div><input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required disabled>
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
                <div class="d-flex justify-content-end gap-3 m-4">
                    <button type="reset" id="reset" class="btn btn-secondary">{{translate('Reset')}}</button>
                    <button type="submit" class="btn btn-primary">{{translate('Add')}}</button>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</div>
@endsection
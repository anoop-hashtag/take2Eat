@extends('layouts.admin.app')

@section('title', translate('Add Recipe'))
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
            <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/inventory/recipe.png')}}" alt="">
            <span class="page-header-title">
                {{translate('Recipe')}} 
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
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="input-label">{{translate('Food_Name')}}<span
                                                    class="input-label-secondary">*</span></label>
                                            <select name="qty_type" class="custom-select" >
                                                <option selected disabled>Food Name</option>
                                                <option value="kg">{{translate('Supplier 1')}}</option>
                                                <option value="litre">{{translate('Supplier 2')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="input-label">{{translate('Variation')}}<span
                                                    class="input-label-secondary">*</span></label>
                                            <select name="qty_type" class="custom-select" >
                                                <option selected disabled>Variation</option>
                                                <option value="kg">{{translate('Supplier 1')}}</option>
                                                <option value="litre">{{translate('Supplier 2')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            <div class="set_table banner-tbl mt-4">
                                <div class="table-responsive datatable_wrapper_row">
                                    <table id="datatable"   class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>{{translate('SL')}}</th>
                                            <th>{{translate('Ingredient list')}}</th>
                                            <th> {{translate('Qty')}}</th>
                                            <th> {{translate('Action')}}</th>
                                            <th> <button  type="button" onclick="addRecipeTbl();" class="btn btn-primary btn-sm delete square-btn"
                                                ><i class="tio-add"></i></button>
                                           </th>
                                        </tr>
                                        </thead>
            
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td><div>
                                                    <select name="qty_type" class="custom-select" >
                                                        <option selected disabled>Select Ingredient List</option>
                                                        <option value="kg">{{translate('Oil')}}</option>
                                                        <option value="litre">{{translate('Gram')}}</option>
                                                    </select></div>
                                                </td>
                                                <td> <div>
                                                    <select name="qty_type" class="custom-select" >
                                                        <option selected disabled>1</option>
                                                        <option value="kg">{{translate('2')}}</option>
                                                        <option value="litre">{{translate('3')}}</option>
                                                    </select></div></td>
                                                <td>
                                                    <div class="d-flex  gap-2">
                                                        <a class="btn btn-outline-info btn-sm edit square-btn"
                                                            href="#"><i class="tio-edit"></i></a>
                                                     </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex  gap-2">
                                                        <a href="#">
                                                            <button type="button" class="btn btn-outline-danger btn-sm delete square-btn"
                                                            onclick="'{{translate('Want to delete this banner')}}')"><i class="tio-delete"></i></button>
                                                        </a>
            
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
                            <div class="d-flex justify-content-end gap-3 m-4">
                                <button type="reset" id="reset" class="btn btn-secondary">{{translate('Reset')}}</button>
                                <button type="submit" class="btn btn-primary">{{translate('Add')}}</button>
                            </div>
                     
                    </div>
            </form>
        </div>
    </div>
</div>
<script>
    var faqs_row = 0;
function addRecipeTbl() {
html = '<tr>';
html += '<td>1</td>';
html += '<td><div><select name="qty_type" class="custom-select"><option selected disabled>Select Ingredient List</option><option value="kg">{{translate('Oil')}}</option><option value="litre">{{translate('Gram')}}</option></select></div></td>';
html += '<td><div><select name="qty_type" class="custom-select"><option selected disabled>1</option><option value="kg">{{translate('2')}}</option><option value="litre">{{translate('3')}}</option></select></div></td>';
html += '<td><div><a class="btn btn-outline-info btn-sm edit square-btn"href="#"><i class="tio-edit"></i></a></div></td>';
html += '<td><div><a href="#"><button type="button" class="btn btn-outline-danger btn-sm delete square-btn"><i class="tio-delete"></i></button></a></div></td>';
html += '</tr>';
$('#datatable tbody').append(html);
faqs_row++;
}
</script>
@endsection
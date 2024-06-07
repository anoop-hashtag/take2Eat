@extends('layouts.admin.app')

@section('title', translate('Purchase'))

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/inventory/purchase.png')}}" alt="">
            <span class="page-header-title">
                {{translate('Purchase')}} 
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
                                        <label class="input-label">{{translate('Supplier list')}}<span
                                                class="input-label-secondary">*</span></label>
                                        <select name="qty_type" class="custom-select" >
                                            <option selected disabled>Select any supplier</option>
                                            <option value="kg">{{translate('Supplier 1')}}</option>
                                            <option value="litre">{{translate('Supplier 2')}}</option>
                                        </select>
                                    </div>
                                        <div class="form-group">
                                            <label class="input-label">{{translate('Purchase_Date')}}</label>
                                            <input type="text" name="email" class="form-control" placeholder="{{translate('ABC@gmail.com')}}" required>
                                        </div>
                                   

                                    <div class="form-group">
                                        <label class="input-label">{{translate('Note')}}</label>
                                        <textarea name="address" class="form-control" required="" placeholder="{{translate('Ex: ABC')}}" style="resize: none;"></textarea>
                                </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label">{{translate('Invoice')}} </label>
                                        <input type="text" name="mobile" class="form-control" placeholder="{{translate('invoice')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-label">{{translate('Purchase_Type')}}</label>
                                        <input type="text" name="purchase_type" class="form-control" placeholder="{{translate('Purchase_type')}}" required>
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
                <div class="new-top px-card " >
                    <div class="row align-items-center gy-2">
                        <div class="col-sm-4 col-md-6 col-lg-8">
                            <h5 class="d-flex align-items-center gap-2 mb-0">
                                {{translate('Purchase_List')}}
                                <span class="badge badge-soft-dark rounded-50 fz-12">10</span>
                            </h5>
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
                    <div class="table-responsive datatable_wrapper_row "  style="padding: 0 10px;">
                        <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th class="width-inventory-secondary">{{translate('Purchase Item')}}</th>
                                <th class="width-inventory-primary">{{translate('Quantity')}}</th>
                                <th class="width-inventory-primary">{{translate('Rate')}}</th>
                                <th class="width-inventory-primary">{{translate('Total')}}</th>
                                <th> <button  type="button" onclick="addfaqs();" class="btn btn-primary btn-sm delete square-btn"
                                    ><i class="tio-add"></i></button>
                               </th>
                            </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                  <div >
                                        <select name="qty_type" class="custom-select" >
                                            <option selected disabled>Select any supplier</option>
                                            <option value="kg">{{translate('Supplier 1')}}</option>
                                            <option value="litre">{{translate('Supplier 2')}}</option>
                                        </select></div>
                                    </td>
                                    <td>
                                        <div >  <input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                        </div>
                                        </td>
                                   <td>
                                    <div> <input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required>
                                    </div>
                                    </td>
                                    <td>
                                        <div > <input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required disabled>
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
                <!-- End Table -->
            </div>
            <!-- End Card -->
        </div>
    </div>
</div>


<script>
    var faqs_row = 0;
function addfaqs() {
html = '<tr>';
html += '<td><select name="qty_type" class="custom-select"><option selected disabled>Select any supplier</option><option value="kg">{{translate('Supplier 1')}}</option><option value="litre">{{translate('Supplier 2')}}</option></select></td>';
html += '<td><input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required></td>';
html += '<td><input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required></td>';
html += '<td><input type="text" name="text" class="form-control" placeholder="{{translate('1')}}" required disabled></td>';
html += '<td><div class="d-flex  gap-2"><a href="#"><button type="button" class="btn btn-outline-danger btn-sm delete square-btn"><i class="tio-delete"></i></button></a></div></td>';
html += '</tr>';
$('#datatable tbody').append(html);

faqs_row++;
}
</script>


@endsection
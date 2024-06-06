@extends('layouts.admin.app')

@section('title', translate('Ingredient'))

@push('css_or_js')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/inventory/inventory.png')}}" alt="">
            <span class="page-header-title">
                Ingredient/Stock
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
                                        <label class="input-label">Name</label>
                                        <input type="text" name="title" class="form-control" placeholder="Ingredients" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label">Quantity type<span
                                                class="input-label-secondary">*</span></label>
                                        <select name="qty_type" class="custom-select" >
                                            <option selected disabled>select qty type</option>
                                            <option value="kg">kg</option>
                                            <option value="litre">litre</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <button type="reset" id="reset" class="btn btn-secondary">reset</button>
                                <button type="submit" class="btn btn-primary">Add</button>
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
                            <h5 class="d-flex align-items-center gap-2 mb-0">
                                Inventory List
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
                    <div class="table-responsive datatable_wrapper_row "  style="padding-right: 10px;">
                        <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Stock 1</td>
                                    <td>1kg</td>
                                    <td>
                                        <div class="d-flex  gap-2">
                                            <a class="btn btn-outline-info btn-sm edit square-btn"
                                                href="#"><i class="tio-edit"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete square-btn"
                                                onclick="('Want to delete this inventory')"><i class="tio-delete"></i></button>
                                        </div>
                                        
                                    </td>
                                </tr>
                            @endforeach
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
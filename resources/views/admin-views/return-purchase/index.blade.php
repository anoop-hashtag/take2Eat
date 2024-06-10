@extends('layouts.admin.app')

@section('title', translate('Return_purchase')) 

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img " src="{{asset('public/assets/admin/img/inventory/return.png')}}" alt="">
            <span class="page-header-title">
                {{translate('Return Purchase list')}}
            </span>     <span class="badge badge-soft-dark rounded-50 fz-12">12</span>
           
        </h2>
    </div>
    <!-- End Page Header -->


    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-top px-card">
                    <div class="d-flex flex-column flex-md-row flex-wrap  align-items-md-center">
                        <div class="d-flex flex-wrap align-items-center">
                            <a href="{{ route('admin.return-purchase.add') }}" type="button" class="btn btn-primary btn-attribute" >
                                <i class="tio-add"></i>
                                {{translate('Add_Return_Purchase')}}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="set_table new-responsive attribute-list" style="margin-top:50px">
                    <div class="table-responsive datatable_wrapper_row"  >
                        <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{translate('SL')}}</th>
                                    <th>{{translate('Invoice')}}</th>
                                    <th>{{translate('Supplier')}}</th>
                                    <th>{{translate('Date')}}</th>
                                    <th>{{translate('Price')}}</th>
                                    <th>{{translate('Status')}}</th>
                                    <th>{{translate('Action')}}</th>
                                </tr>
                            </thead>

                            <tbody>
                          
                                <tr>
                                    <td>1</td>
                                    <td>invoice 1</td>
                                    <td>Supplier 1</td>
                                    <td>12-10-2024</td>
                                    <td>23432</td>
                                    <td>
                                        <div class="">
                                            <label class="switcher">
                                                <input  class="switcher_input" type="checkbox" >
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Dropdown -->
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
            </div>
        </div>
        <!-- End Table -->
    </div>
</div>
@endsection
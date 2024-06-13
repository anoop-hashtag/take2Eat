@extends('layouts.admin.app')

@section('title', translate('Purchase Details'))

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img " src="{{asset('public/assets/admin/img/icons/attribute.png')}}" alt="">
            <span class="page-header-title">
                {{translate('Purchase Details')}}
            </span> 
        </h2>
    </div>
    <!-- End Page Header -->
            <div class="card mb-3 mb-lg-5">
                    <div class="card-body bottom-new-line">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="vendor-data " >
                                    <span class="vendor-title"> Vendor Name : </span>
                                    <span>Sweta Sachan</span>
                                </div>
                                <div class="vendor-data" >
                                    <span class="vendor-title"> Invoice No. : </span>
                                    <span>2343</span>
                                </div>
                            </div>       
                            <div class="col-lg-6">
                                <div class="vendor-data" >
                                    <span class="vendor-title"> Purchase Date : </span>
                                    <span>12-02-2024</span>
                                </div>
                                <div class="vendor-data" >
                                    <span class="vendor-title">Payment Type : </span>
                                    <span>Credit Card</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="vendor-data" >
                                    <span class="vendor-title">Description : </span>
                                    <span>Customer notify message for food preparation time change</span>
                                </div>
                            </div>
                        </div>
                    </div>
               
                    <div class="px-card">
                        <div class="py-4 table-responsive">
                        <table class="table-style table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('Item Details')}}</th>
                                <th>{{translate('Quantity')}}</th>
                                <th>{{translate('Quantity Type')}}</th>
                                <th>{{translate('Rate')}}</th>
                                <th>{{translate('Total')}}</th>
                            </tr>
                            </thead>  
                            <tbody>
                                <tr>
                                    <td>{{translate('1')}}</td>
                                    <td>{{translate('Masala Dosa')}}</td>
                                    <td>{{translate('4')}}</td>
                                    <td>{{translate('Lorem Data')}}</td>
                                    <td>2323</td>
                                    <td>2132</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
    
</div>
@endsection
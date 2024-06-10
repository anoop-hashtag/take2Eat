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
                    <form action="{{ route('admin.vendor.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="input-label">{{translate('Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="{{translate('vendor')}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="input-label">{{translate('Mobile')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile" class="form-control" placeholder="{{translate('Mobile')}}" required>
                                </div>

                                <div class="form-group">
                                    <label class="input-label">{{translate('Address')}} <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control"  placehder="{{translate('Ex: ABC')}}" style="resize: none;"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="input-label">{{translate('Email')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control" placeholder="{{translate('abc@gmail.com')}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="input-label">{{translate('GST')}}</label>
                                    <input type="text" name="gst" class="form-control" placeholder="{{translate('GST')}}">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button type="reset" id="reset" class="btn btn-secondary">{{translate('Reset')}}</button>
                            <button type="submit" class="btn btn-primary">{{translate('Add')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-12">
            <!-- Card -->
            <div class="card">
                <div class="card-body">
                    <!-- Table -->
                    <div class="set_table banner-tbl">
                        <div class="table-responsive datatable_wrapper_row">
                            <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{translate('SL')}}</th>
                                        <th>{{translate('name')}}</th>
                                        <th>{{translate('contact_info')}}</th>
                                        <th>{{translate('GST')}}</th>
                                        <th>{{translate('address')}}</th>
                                        <th>{{translate('action')}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($vendors as $vendor)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $vendor->name }}</td>
                                            <td>{{ $vendor->mobile }} <br/> {{ $vendor->email }}</td>
                                            <td>{{ $vendor->gst }}</td>
                                            <td>{{ $vendor->address }}</td>
                                            <td>
                                                <div class="d-flex  gap-2">
                                                    <a href="{{ route('admin.vendor.edit', [$vendor->id]) }}" class="btn btn-outline-info btn-sm edit square-btn"><i class="tio-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Table -->
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</div>

@endsection

@push('script_2')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).on('ready', function () { 
  
            // INITIALIZATION OF DATATABLES
            var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        className: 'd-none'
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'csv',
                        className: 'd-none'
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'print',
                        className: 'd-none'
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                info: false,
                paging: true,
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                        '<img class="mb-3" src="{{asset('public/assets/admin')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                        '<p class="mb-0">{{translate('No data to show')}}</p>' +
                        '</div>'
                },
                order: [], // Add this line to enable sorting on all columns
                columnDefs: [
                    { orderable: true, targets: '_all' } // Ensure all columns are orderable
                ]
            });

        });
    </script>
@endpush